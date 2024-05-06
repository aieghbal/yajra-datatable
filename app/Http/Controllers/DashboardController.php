<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\Datatables;
use App\DataTables\UsersDataTable;
use App\DataTables\ArticleDataTable;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\Validator;
class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $tags = Tag::all();
        $categories = Category::all();

        /*$data = Article::all();
        $tags1 = $data[2]->tags()->get();
        $array = '';
        foreach ($tags1 as $tag){
            $array .= $tag->id.',';
        }*/
        if ($request->ajax()) {
            //$data = Article::popular(25);

            $data = Article::query();
            return Datatables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('date', function($row){
                    $jDate = jdate($row->created_id)->format('Y-m-d  H:i:s');;
                    return $jDate;
                })

                ->editColumn('description', function($row){
                    return $row->description;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard',compact('tags','categories'));

    }


    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string|max:50',
            'categories' => 'required',
            'tags' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/dashboard')
                ->withErrors($validator)
                ->withInput();
        }
        $article = new Article;
        $article->title = $request->title;
        $article->isActive = $request->isActive;
        $article->user_id = Auth::user()->id;
        $article->description = $request->description;
        $article->category_id = $request->categories;


        $article->save();
        foreach ($request->tags as $item){
            $tag = Tag::find($item);
            $last_article = Article::find($article->id);
            $last_article->tags()->save($tag);
        }
        return redirect('/dashboard');
    }

    public function delete($id)
    {
        $article = Article::where('id',$id)->delete();

        return redirect('/dashboard');
        //return redirect('dashboard');
    }

    public function edit($id)
    {
        dd($id);
    }

    public function getArticleData(Request $request){

        ## Read POST data
        $id = $request->post('id');

        $article = Article::find($id);
        $category = $article->category()->get();

        $tags1 = $article->tags()->get();
        $array = '[';
        foreach ($tags1 as $tag){
            $array .= '{id:'.$tag->id.',title:'."'".$tag->title."'".'},';
        }
        $array .= ']';
        $response = array();
        if(!empty($article)){

            $response['title'] = $article->title;
            $response['description'] = $article->description;
            $response['isActive'] = $article->isActive;
            $response['category'] = $category[0]->id;
            $response['categoryTitle'] = $category[0]->title;
            $response['tag'] = $array;

            $response['success'] = 1;
        }else{
            $response['success'] = 0;
        }

        return response()->json($response);

    }

    // Update Article record
    public function updateArticleData(Request $request){

        /*$validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string|max:50',
            'categories' => 'required',
            'tags' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/dashboard')
                ->withErrors($validator)
                ->withInput();
        }*/
        ## Read POST data
        $id = $request->post('id');

        $article = Article::find($id);

        $response = array();
        if(!empty($article)){
            $updata['title'] = $request->post('title');
            $updata['description'] = $request->post('description');
            $updata['category_id'] = $request->post('categories');

            $article->title = $request->post('title');
            $article->description = $request->post('description');
            $article->category_id = $request->post('categories');

            //if($article->update($updata)){
            if($article->save()){
                $tag = Tag::whereIn('id',$request->post('tags'))->get();
                $last_article = Article::find($article->id);
                $last_article->tags()->sync($tag);

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
    }

}
