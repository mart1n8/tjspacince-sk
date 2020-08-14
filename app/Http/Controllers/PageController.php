<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PageStoreRequest;
use App\Page;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function adminList(){
        $pages=Page::orderBy('title', 'ASC')->paginate(30);
        return view('page.adminList', compact('pages'));
    }
    
    public function show($page_slug){
        if(!$page = Page::where('slug', $page_slug)->first()){
             return abort(404);
        }
        return view('page.show', compact('page')); 
    }

    public function create(){
        $page=new Page;
        return view('page.create', compact('page'));       
    }
    
    public function store(PageStoreRequest $request){
        $page = new Page($request->all());
        $page->slug = Str::slug($page->slug);
        $page->save();
        
        return redirect()->route('page.edit', ['page_id'=>$page->id])->with('succeed','Stránka bola pridaná.');
    } 
    
    public function edit($page_id){
        if(!$page = Page::find($page_id)){
            return redirect()->route('home')->with('error', 'Stránka s týmto ID neexistuje.');
        }
        return view('page.edit', compact('page'));      
    }
    
    public function update(PageStoreRequest $request, $page_id){
        if(!$page = Page::find($page_id)){
            return redirect()->route('home')->with('error', 'Stránka s týmto ID neexistuje.');
        }
        $page->fill($request->all());
        $page->slug = Str::slug($page->slug);
        $page->save();
        
        return redirect()->route('page.edit', ['page_id'=>$page_id])->with('succeed','Stránka bola upravená.');
    }
    
    
    public function delete($page_id){
        if(!$page = Page::find($page_id)){
            return redirect()->route('home')->with('error', 'Stránka s týmto ID neexistuje.');
        }
        $page->delete();
        return redirect()->route('page.adminList')->with('error', 'Stránka bola vymazaná.');
    }
    
    
}
