<?php

namespace App\Http\Livewire\Traits;

use App\Models\Aux\Document;
use Illuminate\Support\Facades\Auth;

Trait HasDocuments
{

    // Documents
    public $documentlist=[];
    public $documentscomponent;
    public $documents_root='/';

    public function documentAdded($doc)
    {
        if ($this->mode=='edit')
        {
            $newDoc=new Document;
            $newDoc->document=$doc['document'];
            $newDoc->description=$doc['description'];
            $newDoc->data='';
            $newDoc->created_by=Auth::user()->id;
            $this->record->documents()->save($newDoc);
            $doc['id']=$newDoc->id;
        }

        $this->documentlist[]=$doc;

        if ($this->mode=='edit')
        {
            $this->emit("setvalue", $this->documentscomponent, $this->documentlist);
        }

    }

    public function documentUpdated($doc)
    {
        if ($this->mode=='edit')
        {
            $document=Document::find($doc)->first();
            if ($document==null) return;
            $document->document=$doc['document'];
            $document->description=$doc['description'];
            $document->data=$doc['data'];
            $document->save();
        }

    }

    public function documentRefresh($uuid, $documentlist)
    {
        $this->documentlist=$documentlist;
    }

    public function documentDeleted($uuid, $id)
    {
        foreach($this->documentlist as $index => $img)
        {
            if ($img['id']==$id)
            {
                unset($this->documentlist[$index]);
            }
        }
    }

}
