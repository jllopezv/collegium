<?php

namespace App\Models\Traits;

use App\Models\Aux\Translation;
use Illuminate\Support\Facades\App;

trait HasTranslation
{

     /**
     * Encode the given value as JSON.
     *
     * @param  mixed  $value
     * @return string
     */
    public function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Get all of the models's translations.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    /**
     * Get the translation attribute.
     *
     * @return \App\Translation
     */
    public function getTranslationAttribute()
    {
        return $this->translations->firstWhere('locale', App::getLocale());

    }

    public function getTranslation($attribute, $locale=null)
    {
        if ($locale==null) $locale=App::getLocale();
        $translate=$this->translations->firstWhere('locale', $locale);
        return($translate->content[$attribute] ?? null);
    }

    public function setTranslation($attribute, $locale, $value)
    {
        if ($locale==null) $locale=App::getLocale();

        if (is_array($value))
        {
            // setTranslation('country',null,[ 'es' => 'Spain', 'fr' => 'Espagne' ])
            foreach($value as $lang => $text)
            {
                $this->translations()->create([ 'content' => [ $attribute => $text, ] , 'locale' => $lang]);
            }
            return($this->translations);
        }
        return $this->translations()->create([ 'content' => [ $attribute => $value, ] , 'locale' => $locale]);
    }

    /**
     * Magic method for retrieving a missing attribute.
     *
     * @param string $attribute
     * @return mixed
     */
    public function __get($attribute)
    {
        if ( in_array($attribute,$this->translatable) )
        {
            return($this->getTranslation($attribute) ?? parent::__get($attribute) );
        }
        return parent::__get($attribute);
    }


}
