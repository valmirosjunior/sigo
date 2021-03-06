<?php

namespace App\Http\Controllers;

use App\Exceptions\Util\ValidationException;
use App\Models\Procedure;
use App\Models\Customer;
use App\Models\StaffCategory;
use App\Models\GroupQuestion;
use App\Models\Util\Constants;
use App\Models\Util\Currency;
use Illuminate\Http\Request;
use NumberFormatter;

class ProcedureController extends Controller
{

    private $procedure;
    private $staff_category;
    private $group_question;

    /**
     * ProcedureController constructor.
     */
    public function __construct()
    {
        $this->procedure = new Procedure();
        $this->staff_category = new StaffCategory();
        $this->group_question = new GroupQuestion();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function read_procedure()
    {
        try{
            $procedures = $this->procedure->read_all()->get();
            return view('procedure.index', ['procedures' => $procedures]);
        }catch (GeneralException $ge){
            return back()->withErrors($ge->getMessage());
        } catch (Exception $e){
            return back()->withErrors("Erro Interno");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_procedure()
    {
        $staff_categories = $this->staff_category->read_all()->get();
        $procedure = new Procedure();
        return view('procedure.create',['staff_categories' => $staff_categories, 'procedure' => $procedure]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $this->procedure->name = $request->input('name');
            $this->procedure->price = Currency::currency_to_float($request->input('price'));
            $this->procedure->cost_price = Currency::currency_to_float($request->input('cost_price'));
            $this->procedure->procedure_time = $request->input('timer');
            $this->procedure->staff_category_id = $request->input('staff_category_id');
            if($this->procedure->create($this->procedure)){
                return redirect('/procedure/read_procedure')->with('success',__('messages.success'));
            }
        }catch (ValidationException $e){
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function show_procedure(Request $request)
    {
        try{
            $id = base64_decode($request->input('id'));
            $procedure = $this->procedure->read($id);
            $staff_categories = $this->staff_category->read_all()->get();
            $groupQuestions = GroupQuestion::read_by_procedure_with_questions($id);
            return view('procedure.update')->with(
                array(
                    'procedure' => $procedure,
                    'staff_categories' => $staff_categories,
                    'groupQuestions' => $groupQuestions
                )
            );
        }catch (\Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function edit_procedure(Request $request)
    {
        try{
            $this->procedure->id = $request->input('id');
            $this->procedure->name = $request->input('name');
            $this->procedure->price = Currency::currency_to_float($request->input('price'));
            $this->procedure->cost_price = Currency::currency_to_float($request->input('cost_price'));
            $this->procedure->procedure_time = $request->input('timer');
            $this->procedure->staff_category_id = $request->input('staff_category_id');
            $this->procedure->edit($this->procedure);
            return redirect('/procedure/read_procedure')->with(Constants::SUCCESS ,__('messages.success'));
        }catch (\Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function delete_procedure(Request $request)
    {
        try{
            $this->procedure->remove(base64_decode($request->input('id')));
            return back()->with(Constants::SUCCESS ,__('messages.success'));
        }catch (\Exception $e){
            return back()->withErrors($e->getMessage());
        }

    }

    public function get_procedure_by_category(Request $request){
        try{
            $procedure = new Procedure();
            $category_id = $request->input('id');
            return $procedure->read_by_category($category_id)->get();
        }catch (\Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }
}
