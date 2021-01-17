<?php

namespace App\Http\Livewire\Filemanager;

use Exception;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
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
    public $path;               // Current path
    public $dir;                // Current Dir
    public $userid;             // User folder
    public $firsttime=true;
    public $filesindir;
    public $selectedfiles=[];
    public $currentselected=null;
    public $filestoshow;
    public $showoptions=false;
    public $showoptionsfolder=false;
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
    public $sourcethumb="";
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
            $this->syncFiles();
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
        $this->root=Storage::disk(config('lopsoft.filemanager_disk'))->path('');
        $this->dir='/';
        $this->userid=$this->getUserFolder();
        $this->currentdir=$this->dir.$this->userid;
        $this->path=config('lopsoft.filemanager_storage_folder').($this->userid!=''?$this->dir:'').$this->userid;
        $this->readFiles();
    }

    public function getPath()
    {
        return ($this->root . $this->path . $this->dir);
    }

    public function getUserFolder()
    {
        $userid=Auth::user()->id;
        if ( Auth::user()->level==1 ) $userid='';
        return $userid;
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
        if (!file_exists($this->root . $this->path . $this->dir) && $this->firsttime)
        {
            mkdir ($this->root . $this->path . $this->dir);
            mkdir ($this->root . 'thumbs/' . $this->path . $this->dir);
            $this->firsttime=false;
        }


        try
        {
            $scanned_directory = scandir( $this->root . $this->path . $this->dir, SCANDIR_SORT_ASCENDING );
        }
        catch(\Exception $e)
        {
            $this->showAlertError("ERROR DE ACCESO<br/>".$e->getMessage());
            $this->filestoshow="<div class='p-4 text-red-800'> ERROR: NO EXISTE LA RUTA</div>";
            return;
        }

        $result=[];
        $info=[];

        $userid=$this->getUserFolder();

        // First Dirs
        foreach ($scanned_directory as $key => $value)
        {

            if (!in_array($value,array(".")))
            {
                if (is_dir( $this->root . $this->path . $this->dir . DIRECTORY_SEPARATOR . $value ) )
                {
                    if ( $value!='..' || ($value=='..' && $this->dir!='/') )
                    {
                        $info=pathinfo( $this->root . $this->path . $this->dir . DIRECTORY_SEPARATOR . $value );
                        $info=array_merge( $info,['size' => filesize( $this->root . $this->path . $this->dir . DIRECTORY_SEPARATOR . $value) ] );
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
                if (!is_dir( $this->root . $this->path . $this->dir . DIRECTORY_SEPARATOR . $value) )
                {
                    $info=pathinfo( $this->root . $this->path . $this->dir . DIRECTORY_SEPARATOR . $value);
                    if (!array_key_exists('extension',$info))
                    {
                        $info=array_merge( $info, ['extension' => '' ]);
                    }
                    $currentpath=Str::after($this->currentdir,$this->root);
                    //if (Str::endsWith($currentpath, '/')) $currentpath=substr($currentpath,0,strlen($currentpath)-1);
                    //if (!Str::startsWith($currentpath, '/')) $currentpath='/'.$currentpath;
                    $info=array_merge( $info,['size' => filesize($this->root . $this->path . $this->dir . DIRECTORY_SEPARATOR . $value) ] );
                    $info=array_merge( $info, ['mime_type' => mime_content_type( $this->root . $this->path . $this->dir . DIRECTORY_SEPARATOR . $value) ]);
                    $info=array_merge( $info, ['url' => asset(Storage::disk(config('lopsoft.filemanager_disk'))->url($this->path . $this->dir .$value)) ]);
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
        $this->currentdir=Storage::disk(config('lopsoft.filemanager_disk'))->path($this->rootdirectory);
        if ( !file_exists($this->currentdir)) mkdir($this->currentdir);
        // Thumbs
        $thumb=Storage::disk(config('lopsoft.filemanager_disk'))->path('thumbs'.DIRECTORY_SEPARATOR.$this->rootdirectory);
        if ( !file_exists($thumb)) mkdir($thumb);
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
        if ($this->currentselected!=null && $this->currentselected['type']!='folder')
        {
            $this->showoptions=sizeof($this->selectedfiles)==0?false:true;
            $this->showoptionsfolder=false;

        }
        else
        {
            $this->showoptionsfolder=sizeof($this->selectedfiles)==0?false:true;
            $this->showoptions=false;
        }
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
            chdir($this->root . $this->path . $this->dir . DIRECTORY_SEPARATOR . $folder);
            if ($folder=='..')
            {
                $this->dir=Str::before( $this->dir, DIRECTORY_SEPARATOR . basename($this->dir) ) . DIRECTORY_SEPARATOR;
                if ($this->dir=='') $this->dir=DIRECTORY_SEPARATOR;
            }
            else
            {
                $this->dir=Str::after(getcwd(), $this->root . $this->path ). DIRECTORY_SEPARATOR;
            }
        }
        catch(\Exception $e)
        {
            $this->showAlertError("NO SE PUDO ACCEDER A $this->root$this->path".DIRECTORY_SEPARATOR."$folder<br/".$e->getMessage());
        }
        finally
        {
            $this->renamebox=false;
            $this->showoptions=false;
            $this->showoptionsfolder=false;
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
            $this->currentselected=$this->filesindir[$index];
        }
        else
        {
            unset($this->selectedfiles[$selectedindex]);
            $this->filesindir[$index]['selected']=false;
            $this->actionindex=-1;
            $this->showoptions=false;
            $this->showoptionsfolder=false;
            $this->currentselected=null;
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
        $this->emit('filemanagerselect', $this->uuid,$this->path.$this->dir, $this->getSelectedFiles(), $this->modelid);
        $this->dispatchBrowserEvent('filemanagerselect', [
            'uuid'  =>  $this->uuid,
            'dir'   =>  $this->path.$this->dir,
            'file'  =>  $this->getSelectedFiles(),
            'modelid'   =>  $this->modelid ]);
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
            $folder="CARPETA_".Str::random(20);
            mkdir($this->root . $this->path . $this->dir . $folder);
            mkdir($this->root . 'thumbs/' . $this->path . $this->dir . $folder);
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
        $this->showConfirm("error","¿SEGURO QUE DESEA ELIMINAR ".$texttoshow." ".$selected[0]['filename'].($selected[0]['type']=='folder'?"":".".$selected[0]['extension'])."?","BORRAR ".$texttoshow,"deleteselectaction","close", null);
    }

    public function deleteSelectAction()
    {

        $selected=$this->getSelectedFiles();
        if (count($selected)>0)
        {
            try{
                if ($selected[0]['type']=='folder')
                {
                    if (!is_readable($this->root . $this->path . $this->dir . $selected[0]['basename']))
                    {
                        $this->showAlertError("NO SE PUEDE ACCEDER AL DIRECTORIO");
                        return;
                    }
                    if ( count(scandir($this->root . $this->path . $this->dir . $selected[0]['basename']))>2 )
                    {
                        $this->showAlertError("EL DIRECTORIO NO ESTÁ VACÍO. NO SE PUEDE BORRAR.");
                        return;
                    }
                    rmdir($this->root . $this->path . $this->dir . $selected[0]['basename']);
                    rmdir($this->root . 'thumbs/' . $this->path . $this->dir . $selected[0]['basename']);
                }
                else
                {
                    unlink($this->root . $this->path . $this->dir . $selected[0]['basename']);
                    unlink($this->root . 'thumbs/' . $this->path . $this->dir . $selected[0]['basename']);
                }
                $this->syncFiles();
            }
            catch(\Exception $e)
            {
                $this->showAlertError("NO SE PUDO REALIZAR LA OPERACIÓN<br/>".$e->getMessage());
                $this->syncFiles();
            }
        }
    }

    public function rename()
    {
        $selected=$this->getSelectedFiles();
        if ($selected[0]['basename']=='..')
        {
            $this->showoptionsfolder=false;
            $this->showoptions=false;
            $this->clearSelected();
            $this->syncFiles();
            return;
        }
        $this->renamebox=true;
        $this->temporaryfilename=$selected[0]['basename'];
        $this->updateFilesRender();
    }

    public function copy()
    {
        $selected=$this->getSelectedFiles();
        $this->copybox=true;
        $this->showoptions=false;
        $this->showoptionsfolder=false;
        $this->source=$this->root.$this->path.$this->dir.$selected[0]['basename'];
        $this->sourcethumb=$this->root.'thumbs/'.$this->path.$this->dir.$selected[0]['basename'];
    }

    public function move()
    {
        $selected=$this->getSelectedFiles();
        $this->movebox=true;
        $this->showoptions=false;
        $this->showoptionsfolder=false;
        $this->source=$this->root.$this->path.$this->dir.$selected[0]['basename'];
        $this->sourcethumb=$this->root.'thumbs/'.$this->path.$this->dir.$selected[0]['basename'];
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

        if ($this->root.$this->path.$this->dir.$selected[0]['basename']==$this->root.$this->path.$this->dir.$this->temporaryfilename)
        {
            $this->renamebox=false;
            $this->showoptions=false;
            $this->clearSelected();
            $this->readFiles();
            return;
        }

        if( file_exists($this->root.$this->path.$this->dir.$this->temporaryfilename) )
        {
            $this->showAlertError("EL ARCHIVO YA EXISTE. ELIJA OTRO NOMBRE");
            $this->renamebox=false;
            $this->showoptions=false;
            $this->clearSelected();
            $this->readFiles();
            return;
        }

        try{
            rename($this->root.$this->path.$this->dir.$selected[0]['basename'], $this->root.$this->path.$this->dir.$this->temporaryfilename);
            rename($this->root.'thumbs/'.$this->path.$this->dir.$selected[0]['basename'], $this->root.'thumbs/'.$this->path.$this->dir.$this->temporaryfilename);
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
            $this->emit("filemanager-savefile",$this->uuid);
        }
    }

    public function saveFile($uuid)
    {
        if ($uuid==$this->uuid)
        {

            $filename='file_'.getNowFile().'.'.$this->fileupload->getClientOriginalExtension();
            $savedimage=$this->fileupload->getFileName();

            try
            {
                copy(Storage::disk(config('lopsoft.temp_disk'))->path(config('lopsoft.temp_dir').DIRECTORY_SEPARATOR.basename($savedimage)) , $this->root.$this->path.$this->dir.$filename);
                unlink(Storage::disk(config('lopsoft.temp_disk'))->path(config('lopsoft.temp_dir').DIRECTORY_SEPARATOR.basename($savedimage) ));

                // Create thumbnail
                $handlerimg=Image::make($this->root.$this->path.$this->dir.$filename)->fit(300);
                $handlerimg->save($this->root.'thumbs/'.$this->path.$this->dir.$filename);


            }
            catch(Exception $e)
            {
                $this->showException($e);
            }
            $this->uploading=false;
            $this->emit('filemanager-upload-postprocess', $filename, $this->root.$this->path.$this->dir, $this->root.$this->path.$this->dir.$filename);
            $this->syncFiles();
            return $savedimage;
        }
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
        $destination=$this->root.$this->path.$this->dir;
        $destinationthumb=$this->root.'thumbs/'.$this->path.$this->dir;
        $target=basename($this->source);
        while( file_exists($destination.$target) )
        {
            $dotpos=strrpos($target,".");
            $ext=substr($target,$dotpos+1, strlen($target)-$dotpos);
            $file=substr($target,0,$dotpos);
            $target=$file."_copy".".".$ext;
        }
        try
        {
            copy( $this->source, $destination.$target);
            copy( $this->sourcethumb, $destinationthumb.$target);

        }
        catch(Exception $e)
        {
            $this->showException($e);
        }
        finally
        {
            $this->copybox=false;
            $this->syncFiles();
        }


    }

    public function applyMove()
    {
        $destination=$this->root.$this->path.$this->dir;
        $destinationthumb=$this->root.'thumbs/'.$this->path.$this->dir;
        $target=basename($this->source);
        // while( file_exists($destination.$target) )
        // {
        //     $dotpos=strrpos($target,".");
        //     $ext=substr($target,$dotpos+1, strlen($target)-$dotpos);
        //     $file=substr($target,0,$dotpos);
        //     $target=$file."_copy".".".$ext;
        // }
        if ($this->source!=$destination.$target)
        {
            try
            {
                copy( $this->source, $destination.$target);
                copy( $this->sourcethumb, $destinationthumb.$target);
                unlink($this->source);
                unlink($this->sourcethumb);


            }
            catch(Exception $e)
            {
                $this->showException($e);
            }

        }
        $this->movebox=false;
        $this->syncFiles();

    }

}
