<?php

namespace App\Http\Livewire\Filemanager;

use Exception;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Livewire\Traits\WithModalAlert;
use App\Http\Livewire\Traits\WithAlertMessage;
use App\Http\Livewire\Traits\WithModalConfirm;

class Filemanager extends Component
{

    use WithModalAlert;
    use WithFileUploads;
    use WithAlertMessage;
    use WithModalConfirm;

    public $isOpen = false;
    public $uuid='filemanager';
    public $rootdirectory;      // dir where filemanager work
    public $root;               // dir base
    public $currentdir;
    public $filesindir;
    public $selectedfiles=[];
    public $filestoshow;
    public $showoptions=false;
    public $multiselect=false;
    public $renamebox=false;
    public $copybox=false;
    public $movebox=false;
    public $temporaryfilename='';
    public $actionindex=-1;
    public $fileupload;
    public $allowedmimetypes='jpg,gif,jpeg,bmp,png';
    public $downloadmimetypes='';
    public $onlyimages=false;
    public $uploading=false;
    public $source="";
    public $modelid;
    public $params;

    protected $listeners = [
        'showFilemanager' => 'open',
        'closeFilemanager' => 'close',
        'deleteselectaction' => 'deleteSelectAction',
        'filemanager_update' => 'filemanagerUpdate',
        'filemanager-savefile' => 'saveFile',
    ];

    public function open($uuid='*', $modelid='', $params)
    {
        if ($uuid=='*' || $uuid==$this->uuid)
        {
            $this->isOpen = true;
            $this->modelid=$modelid;
            $this->params=$params;
            $this->parseParams();
        }
    }

    public function close($uuid='*')
    {
        if ($uuid=='*' || $uuid==$this->uuid)
        {
            $this->clearSelected();
            $this->isOpen = false;
            $this->deleteTemp();
            $this->showoptions=false;
            $this->renamebox=false;
            $this->copybox=false;
            $this->movebox=false;
            $this->syncFiles();
        }
    }

    public function mount()
    {
        $this->rootdirectory=config('lopsoft.filemanager_storage_folder');
        $this->getCurrentDir();
        $this->root=$this->currentdir;
        //if (Str::endsWith($this->currentdir, DIRECTORY_SEPARATOR)) $this->currentdir=Str::substr($this->currentdir, 0, Str::length($this->currentdir)-1);
        $this->readFiles();
    }

    public function parseParams()
    {
        if ($this->params!='')
        {
            $params=explode('|',$this->params);
            foreach($params as $param)
            {
                $key=explode(':', $param)[0];
                $value=explode(':', $param)[1];
                switch($key)
                {
                    case 'types':
                        $this->downloadmimetypes=$value;
                        break;
                }
            }

        }
    }

    public function readFiles()
    {
        try
        {
            $scanned_directory = scandir( $this->currentdir, SCANDIR_SORT_ASCENDING );
        }
        catch(\Exception $e)
        {
            $this->showAlertError("ERROR DE ACCESO<br/>".$e->getMessage());
            $this->filestoshow="<div class='p-4 text-red-800'> ERROR: NO EXISTE LA RUTA</div>";
            return;
        }

        $result=[];
        $info=[];

        // First Dirs
        foreach ($scanned_directory as $key => $value)
        {
            if (!in_array($value,array(".")))
            {
                if (is_dir( $this->currentdir . DIRECTORY_SEPARATOR . $value) )
                {
                    if ( $value!='..' || ($value=='..' && $this->root!=$this->currentdir) )
                    {
                        $info=pathinfo( $this->currentdir.DIRECTORY_SEPARATOR.$value);
                        $info=array_merge( $info,['size' => filesize( $this->currentdir.DIRECTORY_SEPARATOR.$value) ] );
                        $info=array_merge( $info, ['mime_type' => '' ]);
                        $info=array_merge( $info, ['url' => '' ]);
                        $info=array_merge( $info, ['type' => 'folder']);
                        $info=array_merge( $info, [ 'selected' => false ]);
                        $result[] = $info;
                    }
                }
            }
        }
        foreach ($scanned_directory as $key => $value)
        {
            if (!in_array($value,array(".")))
            {
                if (!is_dir( $this->currentdir . DIRECTORY_SEPARATOR . $value) )
                {
                    $info=pathinfo( $this->currentdir.DIRECTORY_SEPARATOR.$value);
                    if (!array_key_exists('extension',$info))
                    {
                        $info=array_merge( $info, ['extension' => '' ]);
                    }
                    $currentpath=Str::after($this->currentdir,$this->root);
                    if (!Str::endsWith($currentpath, '/')) $currentpath.='/';
                    if (!Str::startsWith($currentpath, '/')) $currentpath='/'.$currentpath;
                    $info=array_merge( $info,['size' => filesize( $this->currentdir.DIRECTORY_SEPARATOR.$value) ] );
                    $info=array_merge( $info, ['mime_type' => mime_content_type( $this->currentdir.DIRECTORY_SEPARATOR.$value) ]);
                    $info=array_merge( $info, ['url' => asset(Storage::disk(config('lopsoft.filemanager_disk'))->url(config('lopsoft.filemanager_storage_folder').$currentpath.$value)) ]);
                    $info=array_merge( $info, ['type' => 'file']);
                    $info=array_merge( $info, [ 'selected' => false ]);
                    $result[] = $info;

                }
            }
        }
        $this->filesindir=$result;
        $this->updateFilesRender();
    }

    public function getCurrentDir()
    {
        $this->currentdir=Storage::disk(config('lopsoft.filemanager_disk'))->path($this->rootdirectory.$this->root);
    }

    /**
     * Return index of selectedfile that match with $index. Else false is returned
     *
     * @param  mixed $index
     * @return mixed false | integer
     */
    public function selectedindex($index)
    {
        return array_search($index, $this->selectedfiles);
    }

    public function updateFilesRender()
    {
        $this->showoptions=sizeof($this->selectedfiles)==0?false:true;
        $this->filestoshow=view('lopsoft.filemanager.showfiles',[
            'filesindir'    => $this->filesindir,
            'showoptions'   => $this->showoptions,
            'selectedfiles' => $this->selectedfiles,     //todo: borrar
            'renamebox'     => $this->renamebox ] )->render();
    }

    public function cancelOptions()
    {
        $this->clearSelected();
        $this->showoptions=false;
        $this->syncFiles();
    }

    public function clearSelected()
    {
        $this->actionindex=-1;
        for($i=0;$i<sizeof($this->filesindir);$i++)
        {
            $this->filesindir[$i]['selected']=false;
        }
        $this->selectedfiles=[];
    }

    public function gotoFolder($folder)
    {

        try{
            chdir($this->currentdir.$folder);
            $this->currentdir=getcwd().DIRECTORY_SEPARATOR;
        }
        catch(\Exception $e)
        {
            $this->showAlertError("NO SE PUDO ACCEDER A $this->currentdir.$folder<br/".$e->getMessage());
        }
        finally
        {
            $this->renamebox=false;
            $this->showoptions=false;
            $this->clearSelected();
            $this->readFiles();
        }
    }

    public function select($index)
    {
        $selectedindex=$this->selectedindex($index);
        if ($this->renamebox==false && $selectedindex!==false && $index==$this->actionindex)
        {
            if ($this->filesindir[$this->selectedfiles[$selectedindex]]['type']=='folder')
            {
                $this->gotoFolder($this->filesindir[$this->selectedfiles[$selectedindex]]['basename']);
                return;
            }
        }

        if ($this->renamebox)
        {
            if ($this->filesindir[$index]['selected']) return; // Click in the same is renamed
            $this->applyRename();
        }

        if ($selectedindex===false)
        {
            if (!$this->multiselect)
            {
                $this->clearSelected();
                $this->updateFilesRender();
            }
            $this->selectedfiles[]=$index;
            $this->filesindir[$index]['selected']=true;
            $this->actionindex=$index;
        }
        else
        {
            unset($this->selectedfiles[$selectedindex]);
            $this->filesindir[$index]['selected']=false;
            $this->actionindex=-1;
            $this->showoptions=false;
        }

        $this->updateFilesRender();

    }

    public function getSelectedFiles()
    {
        $selected=[];
        for($i=0;$i<sizeof($this->selectedfiles);$i++)
        {
            $selected[]=$this->filesindir[$this->selectedfiles[$i]];
        }
        return $selected;
    }

    public function applySelect()
    {
        $getfile=$this->getSelectedFiles();
        if ($getfile[0]['type']=='folder')
        {
            $this->clearSelected();
            $this->syncFiles();
            return;
        }
        if ($this->downloadmimetypes!="")
        {
            $mimetypes=explode(',', $this->downloadmimetypes);

            if (!in_array($getfile[0]['extension'], $mimetypes))
            {
                $this->showAlertError("EL ARCHIVO NO ES VÁLIDO. DEBE SER ".$this->downloadmimetypes);
                return;
            }
        }
        $this->emit('filemanagerselect', $this->uuid, Str::after( $this->currentdir, $this->root), $this->getSelectedFiles(), $this->modelid);
        $this->close();
    }

    public function syncFiles()
    {
        $this->clearSelected();
        $this->readFiles();
    }

    public function createFolder()
    {

        try{
            mkdir($this->currentdir.DIRECTORY_SEPARATOR."CARPETA_".Str::random(20));
        }
        catch(\Exception $e)
        {
            $this->showAlertError("NO SE PUDO CREAR LA CARPETA<br/>".$e->getMessage());
        }
        finally
        {
            $this->syncFiles();
        }

    }

     /**
     * Entry point to delete action
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteSelect()
    {
        $selected=$this->getSelectedFiles();
        if ($selected[0]['type']=='folder')
        {
            $texttoshow="LA CARPETA";
        }
        else
        {
            $texttoshow="EL ARCHIVO";
        }
        $this->showConfirm("error","¿SEGURO QUE DESEA ELIMINAR ".$texttoshow." ".$selected[0]['filename'].".".$selected[0]['extension']."?","BORRAR ".$texttoshow,"deleteselectaction","close", null);
    }

    public function deleteSelectAction()
    {

        $selected=$this->getSelectedFiles();

        try{
            if ($selected[0]['type']=='folder')
            {
                rmdir($this->currentdir.$selected[0]['basename']);
            }
            else
            {
                unlink($this->currentdir.$selected[0]['basename']);
            }
            $this->syncFiles();
        }
        catch(\Exception $e)
        {
            $this->showAlertError("NO SE PUDO REALIZAR LA OPERACIÓN<br/>".$e->getMessage());
            $this->syncFiles();
        }
    }

    public function rename()
    {
        $this->renamebox=true;
        $selected=$this->getSelectedFiles();
        $this->temporaryfilename=$selected[0]['basename'];
        $this->updateFilesRender();
    }

    public function copy()
    {
        $selected=$this->getSelectedFiles();
        $this->copybox=true;
        $this->showoptions=false;
        $this->source=$this->currentdir.$selected[0]['basename'];
    }

    public function move()
    {
        $selected=$this->getSelectedFiles();
        $this->movebox=true;
        $this->showoptions=false;
        $this->source=$this->currentdir.$selected[0]['basename'];
    }

    public function cancelAction()
    {
        $this->renamebox=false;
        $this->copybox=false;
        $this->movebox=false;
        $this->updateFilesRender();
    }

    public function applyRename()
    {
        $selected=$this->getSelectedFiles();

        try{
            rename($this->currentdir.DIRECTORY_SEPARATOR.$selected[0]['basename'], $this->currentdir.DIRECTORY_SEPARATOR.$this->temporaryfilename);
        }
        catch(\Exception $e)
        {
            $this->showAlertError("NO SE PUDO RENOMBRAR ".($selected[0]['type']=='file' ? 'EL ARCHIVO' : 'LA CARPETA')."<br/>".$e->getMessage());
        }
        finally
        {
            $this->renamebox=false;
            $this->showoptions=false;
            $this->clearSelected();
            $this->readFiles();
        }
    }

    public function updatedFileupload()
    {
        $this->validate([
            'fileupload' => 'nullable'.( $this->onlyimages?'|image':'').($this->allowedmimetypes!='' ? '|mimes:'.$this->allowedmimetypes : '').'|file|max:'.config('lopsoft.filemanager_max_upload_size')
        ]);

        $this->uploading=false;

        if ($this->fileupload)
        {
            $this->uploading=true;
            $this->emit("filemanager-savefile");
        }
    }

    public function saveFile()
    {
        //$filename=$this->fileupload->getFileName();
        $filename='file_'.getNowFile().'.'.$this->fileupload->getClientOriginalExtension();

        //$savedimage=$this->fileupload->store(config('lopsoft.temp_dir'),config('lopsoft.filemanager_disk'));
        //$handlerimg=Image::make(Storage::disk(config('lopsoft.temp_disk'))->path($savedimage));
        //$ret=$handlerimg->save();
        $savedimage=$this->fileupload->getFileName();

        $currentpath=Str::after($this->currentdir,$this->root);
        if (!Str::endsWith($currentpath, '/')) $currentpath.='/';
        if (!Str::startsWith($currentpath, '/')) $currentpath='/'.$currentpath;

        try
        {
            copy(Storage::disk(config('lopsoft.temp_disk'))->path(config('lopsoft.temp_dir').DIRECTORY_SEPARATOR.basename($savedimage) ),
                 Storage::disk(config('lopsoft.filemanager_disk'))->path(config('lopsoft.filemanager_storage_folder').$currentpath.$filename));
            unlink(Storage::disk(config('lopsoft.temp_disk'))->path(config('lopsoft.temp_dir').DIRECTORY_SEPARATOR.basename($savedimage) ));

            // Create thumbnail
            $handlerimg=Image::make(Storage::disk(config('lopsoft.filemanager_disk'))->path(config('lopsoft.filemanager_storage_folder').$currentpath.$filename))->fit(300);
            $handlerimg->save(Storage::disk(config('lopsoft.filemanager_disk'))->path('thumbs'.DIRECTORY_SEPARATOR.config('lopsoft.filemanager_storage_folder').$currentpath.$filename));


        }
        catch(Exception $e)
        {
            $this->showException($e);
        }
        $this->uploading=false;
        $this->emit('filemanager-upload-postprocess', $filename, $currentpath, Storage::disk(config('lopsoft.filemanager_disk'))->path(config('lopsoft.filemanager_storage_folder').$currentpath.$filename));
        $this->syncFiles();
        return $savedimage;
    }

    public function render()
    {
        return view('livewire.filemanager.filemanager' );
    }

    /**
     * Delete temp files. Valid if the component has temporary files to load like avatars
     *
     * @return void
     */
    public function deleteTemp()
    {
        $list=collect(Storage::disk(config('lopsoft.temp_disk'))->listContents(config('lopsoft.temp_dir'), true))
	        ->each(function($file) {
		        if ($file['type'] == 'file' && $file['timestamp'] < now()->subDays(config('lopsoft.garbagecollection_days'))->getTimestamp()) {
			        Storage::disk(config('lopsoft.temp_disk'))->delete($file['path']);
		        }
        });
    }


    /**
     * Show Exception message
     *
     * @param  mixed $e
     * @return void
     */
    public function showException(\Exception $e)
    {
        $this->showAlertError('SE PRODUJO UN ERROR INESPERADO<br/><br/>'.$e->getMessage(),"ERROR INESPERADO");
    }



    public function applyCopy()
    {
        $currentpath=Str::after($this->currentdir,$this->root);
        if (!Str::endsWith($currentpath, '/')) $currentpath.='/';
        if (!Str::startsWith($currentpath, '/')) $currentpath='/'.$currentpath;
        $destination=Storage::disk(config('lopsoft.filemanager_disk'))->path(config('lopsoft.filemanager_storage_folder').$currentpath);
        if (file_exists($destination.basename($this->source) ))
        {
            $target=$destination.basename($this->source)."_copia";
        }
        else
        {
            $target=$destination.basename($this->source);
        }
        try
        {
            copy( $this->source, $target);
            $this->syncFiles();
        }
        catch(Exception $e)
        {
            $this->showException($e);
        }


    }

    public function applyMove()
    {
        $currentpath=Str::after($this->currentdir,$this->root);
        if (!Str::endsWith($currentpath, '/')) $currentpath.='/';
        if (!Str::startsWith($currentpath, '/')) $currentpath='/'.$currentpath;
        $destination=Storage::disk(config('lopsoft.filemanager_disk'))->path(config('lopsoft.filemanager_storage_folder').$currentpath);
        $target=$destination.basename($this->source);

        if ($target!=$this->source)
        {
            try
            {
                copy( $this->source, $target);
                unlink($this->source);

            }
            catch(Exception $e)
            {
                $this->showException($e);
            }
        }
        $this->syncFiles();


    }

}
