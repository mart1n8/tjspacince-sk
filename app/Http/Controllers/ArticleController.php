<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleStoreRequest;
use App\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    
    public function adminList(){
        $articles=Article::orderBy('created_at', 'DESC')->paginate(30);
        return view('article.adminList', compact('articles'));
    }

    public function index($articles_tag=""){
        if(!empty($articles_tag) or $articles_tag!=""){
            $articles = Article::where('tags', 'like', '%'.$articles_tag.'%')->orderBy('public_date', 'DESC')->paginate(5);
        }else{
            $articles = Article::orderBy('public_date', 'DESC')->paginate(5);
        }
        return view('article.index', compact('articles', 'articles_tag'));
    }
    
    public function show($article_slug){
        if(!$article = Article::where('slug', $article_slug)->first()){
           return redirect()->route('article.index')->with('error','Článok sa v databáze nenachádza.');
        }
        
        //FB META
        $fb_metas = [
            'og:url' => url('clanok/'.$article->slug),
            'og:title' => $article->title,
            'og:type' => 'article',
            'og:description' => strip_tags($article->text),
            'og:image' => !empty($article->fb_share_img) ? asset('images/fb_share_img/'.$article->fb_share_img) : url('public/images/LOGO_TJ_100x100.png'),
        ];
        
        return view('article.show', compact('article', 'fb_metas'));
    }

    public function create(){
        $article=new Article;
        $fbShareImgs = array_diff(scandir('../public/images/fb_share_img/'), array('..', '.'));

        return view('article.create', compact('article', 'fbShareImgs'));       
    }
    
    public function store(ArticleStoreRequest $request){
        $article = new Article($request->all());
        $article->slug = Str::slug($article->title);
        $article->is_publised = !empty($article->is_publised) ? 1 : 0;
        $article->show_on_homepage = !empty($article->show_on_homepage) ? 1 : 0;
        $article->user_id = Auth::id();
        $article->save();
        
        return redirect()->route('article.edit', ['article_id'=>$article->id])->with('succeed','Článok bol pridaný.');
    }    

    public function edit($article_id){
        if(!$article = Article::find($article_id)){
            return redirect()->route('home')->with('error', 'Článok s týmto ID neexistuje.');
        }
        $fbShareImgs = array_diff(scandir('../public/images/fb_share_img/'), array('..', '.'));
        return view('article.edit', compact('article', 'fbShareImgs'));      
    }
    
    public function update(ArticleStoreRequest $request, $article_id){
        if(!$article = Article::find($article_id)){
            return redirect()->route('home')->with('error', 'Článok s týmto ID neexistuje.');
        }
        $article->fill($request->all());
        $article->slug = Str::slug($article->title);
        $article->is_publised = !empty($article->is_publised) ? 1 : 0;
        $article->public_date = date("Y-m-d H:i", strtotime($article->public_date));
        $article->show_on_homepage = !empty($article->show_on_homepage) ? 1 : 0;
        $article->save();
        
        return redirect()->route('article.edit', ['article_id'=>$article_id])->with('succeed','Článok bol upravený.');
          
    }
            
    public function delete($article_id){
        if(!$article = Article::find($article_id)){
            return redirect()->route('home')->with('error', 'Článok s týmto ID neexistuje.');
        }
        $article->delete();
        return redirect()->route('article.adminList')->with('error', 'Článok bol vymazaný.');
    }
}
