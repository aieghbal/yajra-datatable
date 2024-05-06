<?php
namespace App\Http\Controllers;

use App\DataTables\ArticleDataTable;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use http\Env\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class ArticlesController extends Controller
{
    public function getList()
    {
        $categories = Category::all()->pluck('title', 'id')->toArray();
        $categories = Response()->json($categories);
        return view('app',compact('categories'));
    }
    public function index(ArticleDataTable $dataTable)
    {
        $tags = Tag::all();
        $categories = Category::all();
        return $dataTable->render('articles.index',compact('tags','categories'));
    }
    public function getArticle()
    {
        $users = Article::get();
        $arrayVar = [
            "data" => [

            ],
        ];
        foreach ($users as $user){
            array_push($arrayVar["data"], $user);
        }

        return response()->json($arrayVar);
    }
    public function store(ArticleDataTable $editor)
    {
        return $editor->process(request());
    }

    public function delete($id)
    {
        Article::where('id',$id)->delete();

        return redirect('/article/Lists');
    }

    public function getCategories()
    {
        /*$categories = Category::all();
        return json_encode($categories);*/
        $categories = Category::select('id', 'title')->get()->toArray();
        return response()->json($categories);
    }

    public function getTags()
    {
        /*$tags = Tag::all()->pluck('title', 'id')->toArray();
        return response()->json($tags);*/
        $tags = Tag::select('id','title')->get()->toArray();
        return response()->json($tags);
    }

    public function create(Request $request)
    {
        $article = new Article;
        $article->title = $request->title;
        $article->isActive = $request->isActive;
        $article->user_id = Auth::user()->id;
        $article->description = $request->description;
        $article->category_id = $request->categories['id'];

        $response = array();
        if ($article->save()){
            foreach ($request->tags as $item){
                $tag = Tag::find($item['id']);
                $article->tags()->save($tag);
            }
            $response['success'] = 1;
            $response['msg'] = 'َAdd successfully';
        }else{
            $response['success'] = 0;
            $response['msg'] = 'Record not updated';
        }
        //return redirect('/article/Lists');
        return response()->json($response);
    }

    public function update(Request $request)
    {
        $id = $request->post('id');

        $article = Article::find($id);

        $response = array();
        if(!empty($article)){
            $article->title = $request->post('title');
            $article->description = $request->post('description');
            $article->category_id = $request->categories['id'];
            $article->isActive = $request->post('isActive');


            if($article->save()){
                foreach ($request->tags as $item){
                    $tag = Tag::find($item['id']);
                    $article->tags()->save($tag);
                }
                $response['success'] = 1;
                $response['msg'] = 'Update successfully';
            }else{
                $response['success'] = 0;
                $response['msg'] = 'Record not updated';
            }

        }else{
            $response['success'] = 0;
            $response['msg'] = 'Invalid ID.';
        }
        return response()->json($response);
        //return redirect('/article/Lists');
    }
}
