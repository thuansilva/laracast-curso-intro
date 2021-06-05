<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post extends Model
{
    public $title;
    public $date ;
    public $body;
    public $slug;
    public function __construct($title,$date,$body,$slug)
    {
        $this->title= $title;
        $this->date= $date;
        $this->body= $body;
        $this->slug= $slug;

    }

    public static function  alll()
    {
        return cache()->rememberForever('posts.all', function () {
            return  collect(File::files(resource_path('posts')))
             ->map(function($file){
                 return YamlFrontMatter::parseFile($file);
             })
             ->map(function($document){

             return new Post(
                     $document->title,
                     $document->date,
                     $document->body(),
                     $document->slug
                 );
          })->sortByDesc('date');
        });
    }

    public static function find($slug)
    {
        return static::alll()->firstWhere('slug',$slug);
    }

    public static function findOrFail($slug)
    {

      $post = static::find($slug);
      if(!$post ){
          throw new ModelNotFoundException();
      }

      return $post;
    }
}
