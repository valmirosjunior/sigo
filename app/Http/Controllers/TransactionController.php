<?php

namespace App\Http\Controllers;

use App\Models\Procedure;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\TransactionStatus;
use App\Models\Util\Calendar;
use App\Models\Staff;
use App\Models\StaffCategory;
use App\Models\Util\Constants;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exceptions\Util\ValidationException;

class TransactionController extends Controller
{


    private $transaction;
    private $category;
    private $staff;
    private $customer;
    private $procedure;
    const DASHBOARD_NUMBER_DAYS = 55;



    /**
     * TransactionController constructor.
     */
    public function __construct()
    {
        $this->transaction = new Transaction();
        $this->category = new StaffCategory();
        $this->staff = new Staff();
        $this->customer = new Customer();
        $this->transactionStatus = new TransactionStatus();
        $this->procedure = new Procedure();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function read_transaction()
    {
        try {
            $customer = new Customer();
            $customers = $customer->read_all()->get();
            return view('transaction.index', ['customers' => $customers]);
        } catch (GeneralException $ge) {
            return back()->withErrors($ge->getMessage());
        } catch (Exception $e) {
            return back()->withErrors("Erro Interno");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_transaction()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $transaction = new Transaction();
            $customer_id = $request->input('customer_id');
            $transaction->staff_id = $request->input('staff_id');
            $transaction->procedure_id = $request->input('procedure_id');
            $transaction->description = $request->input('description');
            $transaction->customer_id = $customer_id;
            $transaction->create($transaction);
            return redirect()->action('TransactionController@show', ['id' => base64_encode($customer_id)]);
        } catch (ValidationException $ve){
            return back()->withErrors($ve->getMessage())->withInput();
        }catch (Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store_result_procedure(Request $request){
        try {
            $transaction_id = $request->input('transaction_id');
            $request->request->remove('transaction_id');
            $answers = $request->input();
            $transaction = new Transaction();
            $transaction_create = $transaction->structure_transaction_result($transaction_id,$answers);
            if($transaction_create){
                return redirect()->action('TransactionController@show', ['id' => base64_encode(Transaction::findOrFail($transaction_id)->customer_id)]);
            }else{
                return back()->withErrors("Erro Interno");
            }
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $customer_id = base64_decode($request->input('id'));
            $category_all = $this->category->read_all()->get();
            $staff_all = $this->staff->read_all()->get();
            $transactionInCustomer = $this->transaction->read_of_customer($customer_id);
            $customer = $this->customer->read($customer_id);
            $transactionStatuses = $this->transactionStatus->read_all()->get();
            return view('transaction.show ',
                [
                    'transactionOfCustomer' => $transactionInCustomer,
                    'categories' => $category_all,
                    'staffs' => $staff_all,
                    'customer' => $customer,
                    'transactionStatuses' =>$transactionStatuses
                ]
            );
        } catch (GeneralException $ge) {
            return back()->withErrors($ge->getMessage());
        } catch (Exception $e) {
            return back()->withErrors("Erro Interno");
        }
    }


    public function show_transaction(Request $request)
    {
        try {
            $transaction_id = $request->input('id');
            return  $this->transaction->read($transaction_id);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            $id_transaction = $request->input('code');
            $this->transaction->id = $id_transaction;
            $this->transaction->staff_id = $request->input('staff_transaction');
            $this->transaction->cost_price = $request->input('cost_price');
            $this->transaction->price = $request->input('value_procedure');
            $this->transaction->paid = $request->input('situation_transaction');
            $this->transaction->transaction_status_id = $request->input('status_transaction');
            $this->transaction->description = $request->input('description');
            $this->transaction->edit($this->transaction);
            return back();
        } catch (ValidationException $ve){
            return back()->withErrors($ve->getMessage())->withInput();
        }catch (Exception $e){
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function update_transaction(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function delete_transaction(Request $request)
    {
        try {
            $expense_id = $request->input('id');
            if ($this->transaction->remove($expense_id)) {
                return back()->with(Constants::SUCCESS, __('messages.success'));
            }
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function page_transaction_receipt_print(Request $request){

        $id = $request->input('id');

        $transaction = $this->transaction->read_one($id);

        return view('transaction.page_transaction_receipt')->with(array('transaction' => $transaction));
    }

    public function page_transaction_receipt_form_answer(Request $request){

        try {
           $id = $request->input('id');

           $transaction = $this->transaction->read_one($id);

           return view('transaction.page_transaction_receipt')->with(array('transaction' => $transaction));
         } catch (\Exception $e) {
           return back()->withErrors($e->getMessage());
       }
    }



    public function read_group_transaction_by_category(Request $request)
    {
        $start_date = Calendar::invert_date_to_yyyy_mm_dd($request->input('start_date'));
        $end_date = Calendar::invert_date_to_yyyy_mm_dd($request->input('end_date'));
        $status_id = $request->input('status_id');
        $staff_id = $request->input('staff_id');

        return $this->transaction->read_group_transaction_by_category($start_date, $end_date, null, $status_id, $staff_id);
    }

    public function resume_data_to_stack_collumn(Request $request)
    {
        $start_date = Calendar::invert_date_to_yyyy_mm_dd($request->input('start_date'));
        $end_date = Calendar::invert_date_to_yyyy_mm_dd($request->input('end_date'));
        $status_id = $request->input('status_id');
        $staff_id = $request->input('staff_id');

        return $this->transaction->resume_data_to_stack_collumn($start_date, $end_date, null, $status_id, $staff_id);
    }

    public function transactions_report(Request $request)
    {

        $staffs = $this->staff->read_all()->get();
        $transactionStatuses = $this->transactionStatus->read_all()->get();
        $procedures = $this->procedure->read_all()->get();

        return view('reports.transactions_report')->with(array(
            'staffs' => $staffs,
            'transactionStatuses' => $transactionStatuses,
            'procedures' => $procedures
        ));
    }

    public function result_resume_transactions_report(Request $request)
    {
        $start_date = Calendar::invert_date_to_yyyy_mm_dd($request->input('start_date'));
        $end_date = Calendar::invert_date_to_yyyy_mm_dd($request->input('end_date'));
        $status_id = $request->input('status_id');
        $staff_id = $request->input('staff_id');
        $procedure_ids = $request->input('procedure_ids');
        return $this->transaction->resume_transactions_report($start_date, $end_date, $procedure_ids, $status_id, $staff_id);
    }

    public function dashboard_report_total_transaction_by_day(Request $request){
        $start_date = Carbon::now()->subDays(self::DASHBOARD_NUMBER_DAYS)->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');

        $transactions_total = $this->transaction->transactions_by_day_total_value($start_date,$today);

        $transactions_parcial = $this->transaction->transactions_by_day_parcial_value($start_date,$today);

        return array('transactions_total' => $transactions_total, 'transactions_parcial' => $transactions_parcial);
    }

    public function dashboard_report_trasaction_by_category(){
        $start_date = Carbon::now()->subDays(self::DASHBOARD_NUMBER_DAYS)->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');
        return $this->transaction->read_group_transaction_by_category($start_date, $today);
    }

    public function dashboard_report_trasaction_stack_collumn(){
        $start_date = Carbon::now()->subDays(self::DASHBOARD_NUMBER_DAYS)->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');
        return $this->transaction->resume_data_to_stack_collumn($start_date, $today);
    }


}
