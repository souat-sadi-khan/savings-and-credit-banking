<?php

use App\models\utility\ExpenseCategory;
use App\models\accounts\DoubleBenifitAccount;
use App\models\accounts\DpsAccount;
use App\models\accounts\FdrAccount;
use App\models\accounts\LoanAccount;
use App\models\accounts\SavingsAccount;
use App\models\employee\Department;
use App\models\employee\Designation;
use App\models\employee\Employee;
use App\models\employee\EmployeeAttendance;
use App\models\employee\EmployeeDesignation;
use App\models\employee\EmployeeSalary;
use App\User;
use App\models\employee\IdGenerator;
use App\models\expense\Expense;
use App\models\utility\Transaction;
// use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Psy\Readline\Transient;
use App\models\employee\PayrollTransaction;
use App\models\Member\Member;
use App\models\sundry\SundryCalculation;
use App\models\utility\IncomeCategory;

if (!function_exists('_lang')) {
	function _lang($string = '')
	{

		//Get Target language
		$target_lang = get_option('language');

		if ($target_lang == "") {
			$target_lang = "language";
		}

		if (file_exists(resource_path() . "/language/$target_lang.php")) {
			include resource_path() . "/language/$target_lang.php";
		} else {
			include resource_path() . "/language/language.php";
		}

		if (array_key_exists($string, $language)) {
			return $language[$string];
		} else {
			return $string;
		}
	}
}

function formatDate($date)
{
	$dtobj = Carbon\Carbon::parse($date);
	if (get_option('date_format') == 'y-m-d') {
		return $dtformat = $dtobj->format('F jS, Y');
	}
	if (get_option('date_format') == 'Y-m-d') {
		return $dtformat = $dtobj->format('M jS, Y');
	}
	if (get_option('date_format') == 'h-i-s') {
		return $dtformat = $dtobj->format('g:i A');
	}
	if (get_option('date_format') == 'time') {
		return $dtformat = $dtobj->format('h:i A');
	} else {
		return $dtformat = $dtobj->format('F jS Y, g:i A');
	}
}

if (!function_exists('load_language')) {
	function load_language($active = '')
	{
		$path = resource_path() . "/language";
		$files = scandir($path);
		$options = "";

		foreach ($files as $file) {
			$name = pathinfo($file, PATHINFO_FILENAME);
			if ($name == "." || $name == "" || $name == "language") {
				continue;
			}

			$selected = "";
			if ($active == $name) {
				$selected = "selected";
			} else {
				$selected = "";
			}

			$options .= "<option value='$name' $selected>" . ucwords($name) . "</option>";
		}
		echo $options;
	}
}

if (!function_exists('get_language_list')) {
	function get_language_list()
	{
		$path = resource_path() . "/language";
		$files = scandir($path);
		$array = array();

		foreach ($files as $file) {
			$name = pathinfo($file, PATHINFO_FILENAME);
			if ($name == "." || $name == "" || $name == "language") {
				continue;
			}

			$array[] = $name;
		}
		return $array;
	}
}

function gv($params, $keys, $default = Null)
{
	return (isset($params[$keys]) and $params[$keys]) ? $params[$keys] : $default;
}

function gbv($params, $keys)
{
	return (isset($params[$keys]) and $params[$keys]) ? 1 : 0;
}

if (!function_exists('get_option')) {

	function get_option($name, $default = null)
	{
		try {
			DB::connection()
				->getPdo();
			if (!\Illuminate\Support\Facades\Schema::hasTable('settings')) {
				return $default;
			}
			$setting = \Illuminate\Support\Facades\DB::table('settings')->where('name', $name)->first();
			if ($setting) {
				return $setting->value;
			}
			return $default;
		} catch (Exception $e) {
			return $default;
		}
	}
}


function toWord($word)
{
	$word = str_replace('_', ' ', $word);
	$word = str_replace('-', ' ', $word);
	$word = ucwords($word);
	return $word;
}

function tospane($data)
{
	$per = explode('.', $data);
	return toWord($per[1]);
}
//permission
function split_name($name)
{
	$data = [];
	foreach ($name as $value) {
		$per = explode('.', $value->name);
		$data[toWord($per[0])][] = $value->name;
	}
	return $data;
}

function getUserRoleName($user_id)
{
	$user = User::findOrFail($user_id);

	$roles = $user->getRoleNames();

	$role_name = '';

	if (!empty($roles[0])) {
		$array = explode('#', $roles[0], 2);
		$role_name = !empty($array[0]) ? $array[0] : '';
	}
	return $role_name;
}


function tz_list()
{
	$zones_array = array();
	$timestamp = time();
	foreach (timezone_identifiers_list() as $key => $zone) {
		date_default_timezone_set($zone);
		$zones_array[$key]['zone'] = $zone;
		$zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
	}
	return $zones_array;
}

// currency list
function curency()
{
	return $currency = [
		'AED' => '&#1583;.&#1573;', // ?
		'AFN' => '&#65;&#102;',
		'ALL' => '&#76;&#101;&#107;',
		'AMD' => '',
		'ANG' => '&#402;',
		'AOA' => '&#75;&#122;', // ?
		'ARS' => '&#36;',
		'AUD' => '&#36;',
		'AWG' => '&#402;',
		'AZN' => '&#1084;&#1072;&#1085;',
		'BAM' => '&#75;&#77;',
		'BBD' => '&#36;',
		'BDT' => '&#2547;', // ?
		'BGN' => '&#1083;&#1074;',
		'BHD' => '.&#1583;.&#1576;', // ?
		'BIF' => '&#70;&#66;&#117;', // ?
		'BMD' => '&#36;',
		'BND' => '&#36;',
		'BOB' => '&#36;&#98;',
		'BRL' => '&#82;&#36;',
		'BSD' => '&#36;',
		'BTN' => '&#78;&#117;&#46;', // ?
		'BWP' => '&#80;',
		'BYR' => '&#112;&#46;',
		'BZD' => '&#66;&#90;&#36;',
		'CAD' => '&#36;',
		'CDF' => '&#70;&#67;',
		'CHF' => '&#67;&#72;&#70;',
		'CLF' => '', // ?
		'CLP' => '&#36;',
		'CNY' => '&#165;',
		'COP' => '&#36;',
		'CRC' => '&#8353;',
		'CUP' => '&#8396;',
		'CVE' => '&#36;', // ?
		'CZK' => '&#75;&#269;',
		'DJF' => '&#70;&#100;&#106;', // ?
		'DKK' => '&#107;&#114;',
		'DOP' => '&#82;&#68;&#36;',
		'DZD' => '&#1583;&#1580;', // ?
		'EGP' => '&#163;',
		'ETB' => '&#66;&#114;',
		'EUR' => '&#8364;',
		'FJD' => '&#36;',
		'FKP' => '&#163;',
		'GBP' => '&#163;',
		'GEL' => '&#4314;', // ?
		'GHS' => '&#162;',
		'GIP' => '&#163;',
		'GMD' => '&#68;', // ?
		'GNF' => '&#70;&#71;', // ?
		'GTQ' => '&#81;',
		'GYD' => '&#36;',
		'HKD' => '&#36;',
		'HNL' => '&#76;',
		'HRK' => '&#107;&#110;',
		'HTG' => '&#71;', // ?
		'HUF' => '&#70;&#116;',
		'IDR' => '&#82;&#112;',
		'ILS' => '&#8362;',
		'INR' => '&#8377;',
		'IQD' => '&#1593;.&#1583;', // ?
		'IRR' => '&#65020;',
		'ISK' => '&#107;&#114;',
		'JEP' => '&#163;',
		'JMD' => '&#74;&#36;',
		'JOD' => '&#74;&#68;', // ?
		'JPY' => '&#165;',
		'KES' => '&#75;&#83;&#104;', // ?
		'KGS' => '&#1083;&#1074;',
		'KHR' => '&#6107;',
		'KMF' => '&#67;&#70;', // ?
		'KPW' => '&#8361;',
		'KRW' => '&#8361;',
		'KWD' => '&#1583;.&#1603;', // ?
		'KYD' => '&#36;',
		'KZT' => '&#1083;&#1074;',
		'LAK' => '&#8365;',
		'LBP' => '&#163;',
		'LKR' => '&#8360;',
		'LRD' => '&#36;',
		'LSL' => '&#76;', // ?
		'LTL' => '&#76;&#116;',
		'LVL' => '&#76;&#115;',
		'LYD' => '&#1604;.&#1583;', // ?
		'MAD' => '&#1583;.&#1605;.', //?
		'MDL' => '&#76;',
		'MGA' => '&#65;&#114;', // ?
		'MKD' => '&#1076;&#1077;&#1085;',
		'MMK' => '&#75;',
		'MNT' => '&#8366;',
		'MOP' => '&#77;&#79;&#80;&#36;', // ?
		'MRO' => '&#85;&#77;', // ?
		'MUR' => '&#8360;', // ?
		'MVR' => '.&#1923;', // ?
		'MWK' => '&#77;&#75;',
		'MXN' => '&#36;',
		'MYR' => '&#82;&#77;',
		'MZN' => '&#77;&#84;',
		'NAD' => '&#36;',
		'NGN' => '&#8358;',
		'NIO' => '&#67;&#36;',
		'NOK' => '&#107;&#114;',
		'NPR' => '&#8360;',
		'NZD' => '&#36;',
		'OMR' => '&#65020;',
		'PAB' => '&#66;&#47;&#46;',
		'PEN' => '&#83;&#47;&#46;',
		'PGK' => '&#75;', // ?
		'PHP' => '&#8369;',
		'PKR' => '&#8360;',
		'PLN' => '&#122;&#322;',
		'PYG' => '&#71;&#115;',
		'QAR' => '&#65020;',
		'RON' => '&#108;&#101;&#105;',
		'RSD' => '&#1044;&#1080;&#1085;&#46;',
		'RUB' => '&#1088;&#1091;&#1073;',
		'RWF' => '&#1585;.&#1587;',
		'SAR' => '&#65020;',
		'SBD' => '&#36;',
		'SCR' => '&#8360;',
		'SDG' => '&#163;', // ?
		'SEK' => '&#107;&#114;',
		'SGD' => '&#36;',
		'SHP' => '&#163;',
		'SLL' => '&#76;&#101;', // ?
		'SOS' => '&#83;',
		'SRD' => '&#36;',
		'STD' => '&#68;&#98;', // ?
		'SVC' => '&#36;',
		'SYP' => '&#163;',
		'SZL' => '&#76;', // ?
		'THB' => '&#3647;',
		'TJS' => '&#84;&#74;&#83;', // ? TJS (guess)
		'TMT' => '&#109;',
		'TND' => '&#1583;.&#1578;',
		'TOP' => '&#84;&#36;',
		'TRY' => '&#8356;', // New Turkey Lira (old symbol used)
		'TTD' => '&#36;',
		'TWD' => '&#78;&#84;&#36;',
		'TZS' => '',
		'UAH' => '&#8372;',
		'UGX' => '&#85;&#83;&#104;',
		'USD' => '&#36;',
		'UYU' => '&#36;&#85;',
		'UZS' => '&#1083;&#1074;',
		'VEF' => '&#66;&#115;',
		'VND' => '&#8363;',
		'VUV' => '&#86;&#84;',
		'WST' => '&#87;&#83;&#36;',
		'XAF' => '&#70;&#67;&#70;&#65;',
		'XCD' => '&#36;',
		'XDR' => '',
		'XOF' => '',
		'XPF' => '&#70;',
		'YER' => '&#65020;',
		'ZAR' => '&#82;',
		'ZMK' => '&#90;&#75;', // ?
		'ZWL' => '&#90;&#36;',
	];
}

// format date
function carbonDate($date)
{
	$dtobj = Carbon\Carbon::parse($date);
	return $dtformat = $dtobj->format(get_option('date_format'));
}

// format time
function carbonTime($date)
{
	$dtobj = Carbon\Carbon::parse($date);
	return $dtformat = $dtobj->format(get_option('time_format'));
}

// this function is for generating new id ie incrementing the id no
function generate_id($id_type, $update = false)
{
	$last_id = IdGenerator::firstOrCreate(['id_type' => $id_type], ['id_no' => 0]);
	$id = $last_id->id_no;
	$id += 1;
	if ($update) {
		$last_id = IdGenerator::updateOrCreate(['id_type' => $id_type], ['id_no' => $id]);
		$id = $last_id->id_no;
	}
	return $id;
}
// for padding zeros before code of an ID
function numer_padding($id, $code_digits = 3)
{
	$code_digits = (int) $code_digits;

	return str_pad($id, $code_digits, 0, STR_PAD_LEFT);
}

function current_designation($id)
{
	$emp_d = App\models\employee\EmployeeDesignation::where('employee_id', $id)->latest()->first();
	$designation = ($emp_d and $emp_d->designation->name) ? $emp_d->designation->name : "";
	$dept_id = ($emp_d and $emp_d->designation->department_id) ? $emp_d->designation->department_id : "";
	return $designation;
}

function designation_category($id)
{
	$emp_d = App\models\employee\EmployeeDesignation::where('employee_id', $id)->latest()->first();
	$d_id = $emp_d->designation_id;
	$d = App\models\employee\Designation::findOrFail($d_id);
	$category = ($d and $d->category->name) ? $d->category->name : "";
	return $category;
}



function current_dept($id)
{
	$emp_d = App\models\employee\EmployeeDesignation::where('employee_id', $id)->latest()->first();
	// $designation = ($emp_d AND $emp_d->designation->name)?$emp_d->designation->name:"";
	$dept_id = ($emp_d and $emp_d->department_id) ? $emp_d->department_id : "";
	$dept = App\models\employee\Department::where('id', $dept_id)->first();
	return  $dept ? $dept->name : "";
}


function to_date($start_date, $end_date)
{
	$datetime1 = new DateTime($start_date);
	$datetime2 = new DateTime($end_date);
	$interval = $datetime1->diff($datetime2);
	$day = $interval->format('%a');
	$days = $day + 1;
	return  $days;
}


function days_in_month($month, $year)
{
	if (checkdate($month, 31, $year)) return 31;
	if (checkdate($month, 30, $year)) return 30;
	if (checkdate($month, 29, $year)) return 29;
	if (checkdate($month, 28, $year)) return 28;
	return 0; // error
}

function checkatndance($employee, $date)
{
	$reslust = EmployeeAttendance::where('employee_id', $employee)->where('date_of_attendance', $date)->first();
	if ($reslust != null) {
		return $reslust->employee_attendance_type_id;
	} else {
		return false;
	}
}


// this function is for getting current status of services
function current_payment_status($service_type, $service_id)
{
	if ($service_type == 'loan') {
		$main_loan = 0;
		$main_interest = 0;
		$main_grand_total = 0;

		$paid_loan = 0;
		$paid_interest = 0;
		$paid_grand_total = 0;

		$due_loan = 0;
		$due_interest = 0;
		$due_grand_total = 0;
		$paid_installment_no = 0;
		$due_installment_no = 0;

		// Main loan interest grand total calculation
		$loan_info = LoanAccount::where('id', $service_id)->with('loan_confirmation')->latest()->first();
		$main_loan = $loan_info->loan_confirmation->loan_amount;
		$main_interest = ($main_loan * $loan_info->loan_confirmation->interest_rate) / 100;
		$main_grand_total = $main_loan * 1 + $main_interest * 1;

		// Paid loan interest grand total calculation
		$installment_payments = Transaction::where('loan_account_id', $service_id)->where('tx_type', 'loan repay')->get();
		$total_installment_times = count($installment_payments);
		foreach ($installment_payments as  $payment) {
			$paid_installment_no += $payment->no_of_paying_installment;
			$paid_loan += $payment->total_amt;
			$paid_interest += $payment->total_interest_amt;
			$paid_grand_total += $payment->grand_total_amt;
		}
		// dd($paid_installment_no);
		// Due Calculation
		$due_loan = $main_loan - $paid_loan;
		$due_interest = $main_interest - $paid_interest;
		$due_grand_total = $main_grand_total - $paid_grand_total;
		$due_installment_no = $loan_info->installment_no - $paid_installment_no;

		// making all the results an associative array to return Them From This Function
		$result['main_total'] = $main_loan;
		$result['main_interest'] = $main_interest;
		$result['main_grand_total'] = $main_grand_total;

		$result['paid_total'] = $paid_loan;
		$result['paid_interest'] = $paid_interest;
		$result['paid_grand_total'] = $paid_grand_total;

		$result['due_total'] = $due_loan;
		$result['due_interest'] = $due_interest;
		$result['due_grand_total'] = $due_grand_total;
		$result['total_installment_times'] = $total_installment_times;
		$result['paid_installment_no'] = $paid_installment_no;
		$result['due_installment_no'] = $due_installment_no;

		// ::::::::::: 	The followinb block of code is for Savings Account ::::::::::::

	} else if ($service_type == 'savings') {
		$total_deposit = 0;
		$total_withdraw = 0;
		$currntly_in_hand = 0;
		$deposit_times = 0;
		$withdraw_times = 0;

		// total deposit and no of payment for deposit calculatin
		$total_deposit = Transaction::where('savings_account_id', $service_id)->where('tx_type', 'savings payment')->sum('grand_total_amt');
		$deposit_times = Transaction::where('savings_account_id', $service_id)->where('tx_type', 'savings payment')->count();


		// total withdraw and no of payment for withdraw calculatin
		$total_withdraw = Transaction::where('savings_account_id', $service_id)->where('tx_type', 'savings repay')->sum('grand_total_amt');
		$withdraw_times = Transaction::where('savings_account_id', $service_id)->where('tx_type', 'savings repay')->count();

		$savings_withdraw = Transaction::where('savings_account_id', $service_id)->where('tx_type', 'savings repay')->sum('total_amt');
		$interest_withdraw = Transaction::where('savings_account_id', $service_id)->where('tx_type', 'savings repay')->sum('total_interest_amt');


		$sundry_depo = SundryCalculation::where('savings_id', $service_id)->where('tx_type', 'deposit')->sum('submitted_amt');
		$sundry_withdraw = SundryCalculation::where('savings_id', $service_id)->where('tx_type', 'withdraw')->sum('submitted_amt');

		$withdrawable_interest = $sundry_depo - $sundry_withdraw;

		// current balance calculation
		$currntly_in_hand = $total_deposit - $savings_withdraw;
		$max_row = $deposit_times > $withdraw_times ? $deposit_times : $withdraw_times;

		// storing the calculated vlaues to an array called 'result' for returning
		$result['total_deposit'] = $total_deposit;
		$result['total_withdraw'] = $total_withdraw;
		$result['currntly_in_hand'] = $currntly_in_hand;
		$result['deposit_times'] = $deposit_times;
		$result['withdraw_times'] = $withdraw_times;
		$result['max_row'] = $max_row;
		$result['withdrawable_interest'] = $withdrawable_interest;
		$result['savings_withdraw'] = $savings_withdraw;
		$result['savings_withdraw'] = $savings_withdraw;
		$result['interest_withdraw'] = $interest_withdraw;
	} else if ($service_type == 'dps') {
		$total_deposit = 0;
		$total_withdraw = 0;
		$currntly_in_hand = 0;
		$deposit_times = 0;
		$withdraw_times = 0;

		// total deposit and no of payment for deposit calculatin
		$dps_deposits = Transaction::where('dps_account_id', $service_id)->where('tx_type', 'dps payment')->get();
		$deposit_times = count($dps_deposits); //no of payment for deposit calculatin
		foreach ($dps_deposits as  $deposit) {
			$total_deposit += $deposit->grand_total_amt;
		}

		// total withdraw and no of payment for withdraw calculatin
		$dps_withdraws = Transaction::where('dps_account_id', $service_id)->where('tx_type', 'dps repay')->get();
		$withdraw_times = count($dps_withdraws); //no of payment for withdraw calculatin
		foreach ($dps_withdraws as  $withdraw) {
			$total_withdraw += $withdraw->grand_total_amt;
		}

		$max_row = $deposit_times > $withdraw_times ? $deposit_times : $withdraw_times;
		// current balance calculation
		$currntly_in_hand = $total_deposit - $total_withdraw;

		// storing the calculated vlaues to an array called 'result' for returning
		$result['total_deposit'] = $total_deposit;
		$result['total_withdraw'] = $total_withdraw;
		$result['currntly_in_hand'] = $currntly_in_hand;
		$result['deposit_times'] = $deposit_times;
		$result['withdraw_times'] = $withdraw_times;
		$result['max_row'] = $max_row;
	} else if ($service_type == 'share') {
		$total_deposit = 0;
		$total_withdraw = 0;
		$deposit_times = 0;
		$withdraw_times = 0;
		$in_hand  = 0;

		$deposit_info = Transaction::where('share_id', $service_id)->where('tx_type', 'share payment')->get();
		// dd($deposit_info);
		$deposit_times = count($deposit_info); //no of payment for deposit calculatin
		foreach ($deposit_info as  $deposit) {
			$total_deposit += $deposit->grand_total_amt;
		}

		$withdraw_info = Transaction::where('share_id', $service_id)->where('tx_type', 'share repay')->get();
		$total_withdraw = Transaction::where('share_id', $service_id)->where('tx_type', 'share repay')->sum('grand_total_amt');
		$savings_withdraw = Transaction::where('share_id', $service_id)->where('tx_type', 'share repay')->sum('total_amt');
		$interest_withdraw = Transaction::where('share_id', $service_id)->where('tx_type', 'share repay')->sum('total_interest_amt');

		$withdraw_times = count($withdraw_info); //no of payment for deposit calculatin

		$sundry_depo = SundryCalculation::where('share_id', $service_id)->where('tx_type', 'deposit')->sum('submitted_amt');
		$sundry_withd = SundryCalculation::where('share_id', $service_id)->where('tx_type', 'withdraw')->sum('submitted_amt');
		$share_withdrawable = $sundry_depo - $sundry_withd;

		$in_hand  = $total_deposit - $savings_withdraw;

		$max_row = $deposit_times > $withdraw_times ? $deposit_times : $withdraw_times;

		// dd($share_withdrawable);

		// storing the calculated vlaues to an array called 'result' for returning
		$result['total_deposit']  = $total_deposit;
		$result['total_withdraw'] = $total_withdraw;
		$result['interest_withdraw'] = $interest_withdraw;
		$result['savings_withdraw'] = $savings_withdraw;
		$result['share_withdrawable'] = $share_withdrawable;
		$result['deposit_times']  = $deposit_times;
		$result['withdraw_times'] = $withdraw_times;
		$result['deposit_info']   = $deposit_info;
		$result['withdraw_info']  = $withdraw_info;
		$result['in_hand']  = $in_hand;
		$result['max_row']  = $max_row;
	} else if ($service_type == 'double benifit') {
		$main_amount = 0;
		$main_interest = 0;
		$main_grand_total = 0;

		$total_withdraw_amt = 0;
		$total_withdraw_times = 0;
		$per_month_withdrawable = 0;



		// Main amount interest grand total calculation
		// DoubleBenifitAccount

		$double_benifit_info = DoubleBenifitAccount::where('id', $service_id)->latest()->first();

		$main_amount = $double_benifit_info->double_benifit_amt;
		$main_interest = $double_benifit_info->double_benifit_amt;
		$main_grand_total = $double_benifit_info->grand_total_double_benifit;

		$double_benifit_duration  = $double_benifit_info->double_benifit_duration;
		$double_benifit_duration_type  = $double_benifit_info->double_benifit_duration_type;

		if ($double_benifit_duration_type == "Year") {
			$total_month = $double_benifit_duration * 12;
		} else {
			$total_month = $double_benifit_duration * 1;
		}

		$per_month_withdrawable = $main_interest / $total_month;


		// calculating month interval from issue date till now
		$to = Carbon\Carbon::createFromFormat("Y-m-d", date("Y-m-d"));
		$from = Carbon\Carbon::createFromFormat("Y-m-d", $double_benifit_info->issue_date);
		// dd($to);
		$difference_in_month = $to->diffInMonths($from);


		// checking if date is expired or not
		$completation_date = Carbon\Carbon::createFromFormat("Y-m-d", $double_benifit_info->completion_date);

		$expiry = $to >= $completation_date ? 'Yes' : 'No';

		// dd($difference_in_month);
		$total_withdrawable = $per_month_withdrawable * $difference_in_month;

		// Paid loan interest grand total calculation
		$withdraws = Transaction::where('double_benifit_account_id', $service_id)->where('tx_type', 'double benifit repay')->get();
		$total_withdraw_times = count($withdraws);
		foreach ($withdraws as  $withdraw) {

			$total_withdraw_amt += $withdraw->grand_total_amt;
		}
		// Due Calculation
		// $due_loan = $main_loan - $paid_loan;

		if ($expiry == 'Yes') {
			# code...
			$now_withdrable_double_benifit  = $main_amount;
			$now_withdrable_interest = $main_interest;
			$now_total_withdrawable = $main_grand_total;
		} else {
			// $sundry_depo = SundryCalculation::where('double_benifit_id', $service_id)->where('tx_type', 'deposit')->sum('submitted_amt');
			// $sundry_withdraw = SundryCalculation::where('double_benifit_id', $service_id)->where('tx_type', 'withdraw')->sum('submitted_amt');
			// $now_withdrable_interest  = $sundry_depo - $sundry_withdraw;

			$now_withdrable_double_benifit = $main_amount;
			$now_withdrable_interest  = 0;
			$now_total_withdrawable = $main_amount;
		}
		$withdrawable_in_future = $main_grand_total - $total_withdraw_amt;
		$main_amount_withdrawable = $main_amount - $total_withdraw_amt;


		// making all the results an associative array to return Them From This Function
		$result['main_amount'] = $main_amount;
		$result['interest_amt'] = $main_interest;
		$result['with_interest'] = $main_grand_total;
		$result['per_month_withdrawable'] = $per_month_withdrawable;
		$result['total_withdraw_times'] = $total_withdraw_times;
		$result['total_withdraw_amt'] = $total_withdraw_amt;
		$result['now_withdrable_double_benifit'] = $now_withdrable_double_benifit;
		$result['now_withdrable_interest'] = $now_withdrable_interest;
		$result['now_total_withdrawable'] = $now_total_withdrawable;
		$result['withdrawable_in_future'] = $withdrawable_in_future;
		$result['main_amount_withdrawable'] = $main_amount_withdrawable;
		$result['expiry'] = $expiry;
	} else if ($service_type == 'fdr') {
		$main_amount = 0;
		$main_interest = 0;
		$main_grand_total = 0;

		$total_withdraw_amt = 0;
		$total_withdraw_times = 0;
		$per_month_withdrawable = 0;



		// Main amount interest grand total calculation
		// DoubleBenifitAccount

		$fdr_info = FdrAccount::where('id', $service_id)->latest()->first();

		$main_amount = $fdr_info->loan_amt;
		$main_interest = $fdr_info->total_interest_amt;
		$main_grand_total = $fdr_info->grand_total_amt;

		$loan_duration  = $fdr_info->loan_duration;
		$loan_duration_type  = $fdr_info->loan_duration_type;

		if ($loan_duration_type == "Year") {
			$total_month = $loan_duration * 12;
		} else {
			$total_month = $loan_duration * 1;
		}

		$per_month_withdrawable = round($main_interest / $total_month, 2);


		// calculating month interval from issue date till now
		$to = Carbon\Carbon::createFromFormat("Y-m-d", date("Y-m-d"));
		$from = Carbon\Carbon::createFromFormat("Y-m-d", $fdr_info->issue_date);
		// dd($to);
		$difference_in_month = $to->diffInMonths($from);


		// checking if date is expired or not
		$completation_date = Carbon\Carbon::createFromFormat("Y-m-d", $fdr_info->completion_date);

		$expiry = $to >= $completation_date ? 'Yes' : 'No';

		// dd($difference_in_month);
		$total_withdrawable = $per_month_withdrawable * $difference_in_month;

		// Paid loan interest grand total calculation
		$withdraws = Transaction::where('fdr_account_id', $service_id)->where('tx_type', 'fdr repay')->get();
		$total_withdraw_times = count($withdraws);
		foreach ($withdraws as  $withdraw) {

			$total_withdraw_amt += $withdraw->grand_total_amt;
		}
		// Due Calculation
		// $due_loan = $main_loan - $paid_loan;

		if ($expiry == 'yes') {
			# code...
			$now_withdrable_total  = ($total_withdrawable - $total_withdraw_amt) * 1 + $main_amount;
			$now_withdrable_interest = 0;
		} else {
			$sundry_depo = SundryCalculation::where('fdr_id', $service_id)->where('tx_type', 'deposit')->sum('submitted_amt');
			$sundry_withdraw = SundryCalculation::where('fdr_id', $service_id)->where('tx_type', 'withdraw')->sum('submitted_amt');
			$now_withdrable_interest  = $sundry_depo - $sundry_withdraw;


			// $now_withdrable_interest  = $total_withdrawable - $total_withdraw_amt;
			$now_withdrable_total = $main_amount - $total_withdraw_amt;
		}
		$withdrawable_in_future = $main_grand_total - $total_withdraw_amt;
		$main_amount_withdrawable = $main_amount - $total_withdraw_amt;


		// making all the results an associative array to return Them From This Function
		$result['main_amount'] = $main_amount;
		$result['interest_amt'] = $main_interest;
		$result['with_interest'] = $main_grand_total;
		$result['per_month_withdrawable'] = $per_month_withdrawable;
		$result['total_withdraw_times'] = $total_withdraw_times;
		$result['total_withdraw_amt'] = $total_withdraw_amt;
		$result['now_withdrable_total'] = $now_withdrable_total;
		$result['now_withdrable_interest'] = $now_withdrable_interest;
		$result['withdrawable_in_future'] = $withdrawable_in_future;
		$result['main_amount_withdrawable'] = $main_amount_withdrawable;
		$result['expiry'] = $expiry;
	} else if ($service_type == 'dps withdraw') {
		$main_amount = 0;
		$main_interest = 0;
		$main_grand_total = 0;

		$total_withdraw_amt = 0;
		$total_withdraw_times = 0;
		$per_month_withdrawable = 0;



		// Main amount interest grand total calculation
		// DoubleBenifitAccount

		$dps_info = DpsAccount::where('id', $service_id)->latest()->first();
		// dd($dps_info);

		$dps_deposit_info = Transaction::where('dps_account_id', $service_id)->where('tx_type', 'dps payment')->get();
		$dps_deposit_amt = Transaction::where('dps_account_id', $service_id)->where('tx_type', 'dps payment')->sum('grand_total_amt');
		$dps_deposit_times = count($dps_deposit_info);
		$dps_withdraw_info = Transaction::where('dps_account_id', $service_id)->where('tx_type', 'dps repay')->get();
		$dps_withdraw_amt = Transaction::where('dps_account_id', $service_id)->where('tx_type', 'dps repay')->sum('grand_total_amt');
		$dps_withdraw_times = count($dps_withdraw_info);

		$per_month_dps_amt = $dps_info->per_month_dps_amt;
		$interest_rate = $dps_info->interest_rate;

		$dps_duration  = $dps_info->dps_duration;
		$dps_duration_type  = $dps_info->dps_duration_type;

		if ($dps_duration_type == "Year") {
			$total_dps_no = $dps_duration * 12;
		} else {
			$total_dps_no = $dps_duration * 1;
		}

		$interest = $interest_rate / 100;
		$per_month_interest = $per_month_dps_amt * $interest / 12;

		// calculating month interval from issue date till now
		$to = Carbon\Carbon::createFromFormat("Y-m-d", date("Y-m-d"));
		$from = Carbon\Carbon::createFromFormat("Y-m-d", $dps_info->issue_date);



		$total_withdrawable = 0;
		foreach ($dps_deposit_info as $dps_depo) {
			$from = Carbon\Carbon::createFromFormat("Y-m-d", $dps_depo->tx_date);
			$difference_in_month = $to->diffInMonths($from);
			$total_withdrawable += $difference_in_month * $per_month_interest;
		}



		// checking if date is expired or not
		$completation_date = Carbon\Carbon::createFromFormat("Y-m-d", $dps_info->completion_date);

		$expiry = $to >= $completation_date ? 'Yes' : 'No';


		$dps_completation = 'No';
		if ($expiry == 'Yes') {
			if ($dps_deposit_times == $total_dps_no) {
				// $grand_total_withdrawable = $dps_info->grand_total_dps;
				$now_withdrable_dps = $dps_info->total_dps_amt;
				$now_withdrable_interest = $dps_info->total_interest_amt;
				$dps_completation = 'Yes';
			} else {
				$now_withdrable_dps  = $dps_deposit_amt - $dps_withdraw_amt;
				$now_withdrable_interest = 0;
			}
		} else {

			$now_withdrable_dps = $dps_deposit_amt - $dps_withdraw_amt;
			// withdrawable interest will be calculated from sundry calculation table
			// $sundry_depo = SundryCalculation::where('dps_id', $service_id)->where('tx_type', 'deposit')->sum('submitted_amt');
			// $sundry_withdraw = SundryCalculation::where('dps_id', $service_id)->where('tx_type', 'withdraw')->sum('submitted_amt');
			$now_withdrable_interest  = 0;
		}



		$max_row = $dps_deposit_times > $dps_withdraw_times ? $dps_deposit_times : $dps_withdraw_times;
		// making all the results an associative array to return Them From This Function
		$result['total_deposit'] = $dps_deposit_amt;
		$result['total_withdraw'] = $dps_withdraw_amt;
		// $result['currntly_in_hand'] = $currntly_in_hand;
		$result['deposit_times'] = $dps_deposit_times;
		$result['withdraw_times'] = $dps_withdraw_times;
		$result['total_dps_no'] = $total_dps_no;
		// 
		$result['now_total_withdrawable'] = round(($now_withdrable_dps * 1 + $now_withdrable_interest * 1), 2);
		$result['now_withdrable_dps'] = round($now_withdrable_dps, 2);
		$result['now_withdrable_interest'] = round($now_withdrable_interest, 2);
		$result['expiry'] = $expiry;
		$result['dps_completation'] = $dps_completation;
		$result['max_row'] = $max_row;
	}

	return $result;
}


// the following function is for checking a date if that date is in between the current month.
function check_date_within_this_month($date)
{
	// dd($date);
	$startDate = Carbon\Carbon::now();
	$firstDay = $startDate->firstOfMonth()->format('Y-m-d');

	if (strtotime($date) >= strtotime($firstDay)) {
		return true;
	} else {
		return false;
	}
}


// the followig method is for calculating bank withdraw and deposit of a bank account using it's of Bank accounts table
function bank_withdraw_deposit($bank_account_id)
{
	$transaction_info = Transaction::where('bank_account_id', $bank_account_id)->get();

	$withdraw = 0;
	$deposit = 0;
	$in_hand = 0;

	foreach ($transaction_info as  $value) {
		if ($value->tx_type == 'bank repay') {
			$withdraw += $value->grand_total_amt;
		} else {
			$deposit += $value->grand_total_amt;
		}
	}
	$in_hand = $deposit - $withdraw;

	$result['withdraw'] = $withdraw;
	$result['deposit'] = $deposit;
	$result['in_hand'] = $in_hand;

	return $result;
}



// the following function is for getting appended account no or id  of various service and member and employees

function get_id_account_no($type, $prefix = null, $code = null)
{

	if ($type == 'employee') {
		$id = $prefix . numer_padding($code, get_option('digits_employee_code'));
	} else if ($type == 'member') {
		$id = $prefix . numer_padding($code, get_option('digits_member_code'));
	} else if ($type == 'savings') {
		$id = $prefix . numer_padding($code, get_option('digits_savings_account_code'));
	} else if ($type == 'loan') {
		$id = $prefix . numer_padding($code, get_option('digits_loan_account_code'));
	} else if ($type == 'dps') {
		$id = $prefix . numer_padding($code, get_option('digits_dps_code'));
	} else if ($type == 'double_benifit') {
		$id = $prefix . numer_padding($code, get_option('digits_double_benifit_code'));
	} else if ($type == 'fdr') {
		$id = $prefix . numer_padding($code, get_option('digits_loan_from_member_code'));
	} else if ($type == 'invoice') {
		$id = $prefix . numer_padding($code, get_option('digits_invoice_code'));
	} else if ($type == 'share') {
		$id = $prefix . numer_padding($code, get_option('digits_share_code'));
	} else {
		$id = 'N/A';
	}

	return $id;
}



function convert_number_to_words($number)
{

	$hyphen      = '-';
	$conjunction = '  ';
	$separator   = ' ';
	$negative    = 'negative ';
	$decimal     = ' point ';
	$dictionary  = array(
		0                   => 'Zero',
		1                   => 'One',
		2                   => 'Two',
		3                   => 'Three',
		4                   => 'Four',
		5                   => 'Five',
		6                   => 'Six',
		7                   => 'Seven',
		8                   => 'Eight',
		9                   => 'Nine',
		10                  => 'Ten',
		11                  => 'Eleven',
		12                  => 'Twelve',
		13                  => 'Thirteen',
		14                  => 'Fourteen',
		15                  => 'Fifteen',
		16                  => 'Sixteen',
		17                  => 'Seventeen',
		18                  => 'Eighteen',
		19                  => 'Nineteen',
		20                  => 'Twenty',
		30                  => 'Thirty',
		40                  => 'Fourty',
		50                  => 'Fifty',
		60                  => 'Sixty',
		70                  => 'Seventy',
		80                  => 'Eighty',
		90                  => 'Ninety',
		100                 => 'Hundred',
		1000                => 'Thousand',
		1000000             => 'Million',
		1000000000          => 'Billion',
		1000000000000       => 'Trillion',
		1000000000000000    => 'Quadrillion',
		1000000000000000000 => 'Quintillion'
	);

	if (!is_numeric($number)) {
		return false;
	}

	if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
		// overflow
		trigger_error(
			'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
			E_USER_WARNING
		);
		return false;
	}

	if ($number < 0) {
		return $negative . convert_number_to_words(abs($number));
	}

	$string = $fraction = null;

	if (strpos($number, '.') !== false) {
		list($number, $fraction) = explode('.', $number);
	}

	switch (true) {
		case $number < 21:
			$string = $dictionary[$number];
			break;
		case $number < 100:
			$tens   = ((int) ($number / 10)) * 10;
			$units  = $number % 10;
			$string = $dictionary[$tens];
			if ($units) {
				$string .= $hyphen . $dictionary[$units];
			}
			break;
		case $number < 1000:
			$hundreds  = $number / 100;
			$remainder = $number % 100;
			$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
			if ($remainder) {
				$string .= $conjunction . convert_number_to_words($remainder);
			}
			break;
		default:
			$baseUnit = pow(1000, floor(log($number, 1000)));
			$numBaseUnits = (int) ($number / $baseUnit);
			$remainder = $number % $baseUnit;
			$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
			if ($remainder) {
				$string .= $remainder < 100 ? $conjunction : $separator;
				$string .= convert_number_to_words($remainder);
			}
			break;
	}

	if (null !== $fraction && is_numeric($fraction)) {
		$string .= $decimal;
		$words = array();
		foreach (str_split((string) $fraction) as $number) {
			$words[] = $dictionary[$number];
		}
		$string .= implode(' ', $words);
	}

	return $string;
}

function sundry_calculation($service_type = null)
{
	$date = Carbon\Carbon::now();
	$prev_month_first_date = $date->startOfMonth()->subMonth()->format('Y-m-d');
	$prev_month_first_date = Carbon\Carbon::createFromFormat('Y-m-d',  $prev_month_first_date);

	$prev_month_last_date = $date->endOfMonth()->format('Y-m-d');
	$prev_month_last_date = Carbon\Carbon::createFromFormat('Y-m-d',  $prev_month_last_date);

	if (!$service_type) {

		$loan_from_member_sundry_amt =  0;
		$double_benifit_sundry_amt =  0;
		$dps_sundry_amt =  0;
		$share_sundry_amt =  0;
		$savings_sundry_amt =  0;
		$total_sundry_amt =  0;

		// =================  calculate sundry amount of fdr (ie. Loan from members sundry) ===============
		$fdr_model = FdrAccount::where('approval', 'Approved')->where('status', 'Active')->where('completion_date', '>=', $prev_month_last_date)->get();

		foreach ($fdr_model as $fdr_info) {
			// calculating interest per month
			$total_month = calculate_total_month($fdr_info->loan_duration, $fdr_info->loan_duration_type);
			$total_interest_amt = $fdr_info->loan_amt * $fdr_info->interest_rate / 100;
			$interest_per_month = $total_interest_amt / $total_month;

			$to = $prev_month_last_date;
			$from = Carbon\Carbon::createFromFormat("Y-m-d", $fdr_info->issue_date);
			$difference_in_month = $to->diffInMonths($from);

			$deposit_times = SundryCalculation::where('fdr_id', $fdr_info->id)->where('tx_type', 'deposit')->count();
			$sundry_amt_lm = ($difference_in_month - $deposit_times) * $interest_per_month;
			if ($sundry_amt_lm < 0) {
				$sundry_amt_lm = 0;
			}

			$loan_from_member_sundry_amt += $sundry_amt_lm;
		}

		//============  Calculate sundry amount of double benifit  ===============
		$double_benifit_model = DoubleBenifitAccount::where('approval', 'Approved')->where('status', 'Active')->where('completion_date', '>=', $prev_month_last_date)->get();
		foreach ($double_benifit_model as $double_benifit_info) {
			// calculating interest per month
			$total_month = calculate_total_month($double_benifit_info->double_benifit_duration, $double_benifit_info->double_benifit_duration_type);

			$total_interest_amt = $double_benifit_info->double_benifit_amt;
			$interest_per_month = $total_interest_amt / $total_month;

			$to = $prev_month_last_date;
			$from = Carbon\Carbon::createFromFormat("Y-m-d", $double_benifit_info->issue_date);
			$difference_in_month = $to->diffInMonths($from);

			$deposit_times = SundryCalculation::where('double_benifit_id', $double_benifit_info->id)->where('tx_type', 'deposit')->count();
			$sundry_amt_db = ($difference_in_month - $deposit_times) * $interest_per_month;
			if ($sundry_amt_db < 0) {
				$sundry_amt_db = 0;
			}
			$double_benifit_sundry_amt += $sundry_amt_db;
		}


		// ========= calcuation of sundry amount of dps ===========
		$dps_infos = DpsAccount::where('approval', 'Approved')->where('status', 'Active')->where('completion_date', '>=', $prev_month_last_date)->get();
		$dps_sundry_amt = 0;
		foreach ($dps_infos as  $dps_info) {

			$per_month_dps_amt = $dps_info->per_month_dps_amt;
			$interest_rate = $dps_info->interest_rate;
			$total_month = calculate_total_month($dps_info->dps_duration, $dps_info->dps_duration_type);
			$interest = $interest_rate / 100;
			$per_month_interest = $per_month_dps_amt * $interest / 12;
			$dps_deposits = Transaction::where('dps_account_id', $dps_info->id)->where('tx_type', 'dps payment')->get();

			$to = $prev_month_last_date;

			foreach ($dps_deposits as $dps_depo) {
				$from = Carbon\Carbon::createFromFormat("Y-m-d", $dps_depo->tx_date);
				$difference_in_month = $to->diffInMonths($from);
				$deposit_times = SundryCalculation::where('dps_id', $dps_info->id)->where('tx_type', 'deposit')->count();
				$dps_sund_amt = ($difference_in_month - $deposit_times) * $per_month_interest;
				if ($dps_sund_amt < 0) {
					$dps_sund_amt = 0;
				}
				$dps_sundry_amt += $dps_sund_amt;
			}
		}



		$total_sundry_amt = $loan_from_member_sundry_amt + $double_benifit_sundry_amt + $dps_sundry_amt + $share_sundry_amt + $savings_sundry_amt;

		$sundry['loan_from_member_sundry_amt'] =  $loan_from_member_sundry_amt;
		$sundry['double_benifit_sundry_amt'] =  $double_benifit_sundry_amt;
		$sundry['dps_sundry_amt'] =  $dps_sundry_amt;
		$sundry['share_sundry_amt'] =  $share_sundry_amt;
		$sundry['savings_sundry_amt'] =  $savings_sundry_amt;
		$sundry['total_sundry_amt'] =  $total_sundry_amt;

		return $sundry;
	} else {
		if ($service_type == 'share') {
			$total_share_sundry  = 0;
			$share_infos =  Member::all();
			$exist = 0;
			foreach ($share_infos as $share_info) {
				$exist = 1;
				$share[] = $share_info;
				$sundry_amt[] = 0;
				$total_share_sundry  += 0;
			}
			$sundry['total'] = $total_share_sundry;
			$sundry['info'] = $share;
			$sundry['amt'] = $sundry_amt;
			$sundry['exist'] = $exist;
			return $sundry;
		} elseif ($service_type ==  'dps') {
			$dps_infos = DpsAccount::where('approval', 'Approved')->where('status', 'Active')->where('completion_date', '>=', $prev_month_last_date)->get();
			$total_dps_sundry = 0;
			$exist = 0;
			foreach ($dps_infos as  $dps_info) {
				$exist = 1;

				$per_month_dps_amt = $dps_info->per_month_dps_amt;
				$interest_rate = $dps_info->interest_rate;
				$total_month = calculate_total_month($dps_info->dps_duration, $dps_info->dps_duration_type);
				$interest = $interest_rate / 100;
				$per_month_interest = $per_month_dps_amt * $interest / 12;
				$dps_deposits = Transaction::where('dps_account_id', $dps_info->id)->where('tx_type', 'dps payment')->get();
				// calculating month interval from issue date till now
				$to = $prev_month_last_date;
				$amt = 0;
				foreach ($dps_deposits as $dps_depo) {
					$from = Carbon\Carbon::createFromFormat("Y-m-d", $dps_depo->tx_date);
					$difference_in_month = $to->diffInMonths($from);
					$deposit_times = SundryCalculation::where('dps_id', $dps_info->id)->where('tx_type', 'deposit')->count();
					$dps_sund_amt = ($difference_in_month - $deposit_times) * $per_month_interest;
					if ($dps_sund_amt < 0) {
						$dps_sund_amt = 0;
					}
					// $dps_sundry_amt += $dps_sund_amt;

					$amt += $dps_sund_amt;
				}
				$total_dps_sundry += $amt;

				$dps[] = $dps_info;
				$sundry_amt[] = $amt;
			}

			$sundry['info'] = $dps;
			$sundry['amt'] = $sundry_amt;

			$sundry['total'] = $total_dps_sundry;

			$sundry['exist'] = $exist;
			return $sundry;
		} elseif ($service_type ==  'savings') {
			$savings_infos = SavingsAccount::where('status', 'Active')->get();
			$total_savings_sundry  = 0;
			$exist = 0;
			foreach ($savings_infos as $savings_info) {
				$savings[] = $savings_info;
				$sundry_amt[] = 0;
				$total_savings_sundry  += 0;
				$exist = 1;
			}
			$sundry['total'] = $total_savings_sundry;
			$sundry['info'] = $savings;
			$sundry['amt'] = $sundry_amt;
			$sundry['exist'] = $exist;
			return $sundry;
		} elseif ($service_type ==  'double_benifit') {
			// Calculate sundry amount of double benifit
			$double_benifit_sundry_amt = 0;
			$sundry_amt = 0;
			$exist = 0;
			$double_benifit_model = DoubleBenifitAccount::where('approval', 'Approved')->where('status', 'Active')->where('completion_date', '>=', $prev_month_last_date)->get();
			foreach ($double_benifit_model as $double_benifit_info) {
				// calculating interest per month
				$total_month = calculate_total_month($double_benifit_info->double_benifit_duration, $double_benifit_info->double_benifit_duration_type);

				$total_interest_amt = $double_benifit_info->double_benifit_amt;
				$interest_per_month = $total_interest_amt / $total_month;

				$to = $prev_month_last_date;
				$from = Carbon\Carbon::createFromFormat("Y-m-d", $double_benifit_info->issue_date);
				$difference_in_month = $to->diffInMonths($from);



				$deposit_times = SundryCalculation::where('double_benifit_id', $double_benifit_info->id)->where('tx_type', 'deposit')->count();
				$sundry_amt = ($difference_in_month - $deposit_times) * $interest_per_month;

				if ($sundry_amt < 0) {
					$sundry_amt = 0;
				}
				$double_benifit_sundry_amt += $sundry_amt;

				$double_benifit[] = $double_benifit_info;
				$amt[] = $sundry_amt;
				$exist = 1;
			}
			// $sundry['total_savings_sundry'] = $total_savings_sundry;
			$sundry['info'] = $double_benifit;
			$sundry['amt'] = $amt;
			$sundry['total'] = $double_benifit_sundry_amt;
			$sundry['exist'] = $exist;
			return $sundry;
		} elseif ($service_type ==  'loan_from_member') {
			// calculate sundry amount of fdr (ie. Loan from members sundry)
			$loan_from_member_sundry_amt = 0;
			$fdr_model = FdrAccount::where('approval', 'Approved')->where('status', 'Active')->where('completion_date', '>=', $prev_month_first_date)->get();
			$exist = 0;
			foreach ($fdr_model as $fdr_info) {
				// calculating interest per month
				$total_month = calculate_total_month($fdr_info->loan_duration, $fdr_info->loan_duration_type);
				$total_interest_amt = $fdr_info->loan_amt * $fdr_info->interest_rate / 100;
				$interest_per_month = $total_interest_amt / $total_month;

				$to = $prev_month_last_date;
				$from = Carbon\Carbon::createFromFormat("Y-m-d", $fdr_info->issue_date);
				$difference_in_month = $to->diffInMonths($from);


				$deposit_times = SundryCalculation::where('fdr_id', $fdr_info->id)->where('tx_type', 'deposit')->count();
				$sundry_amt = ($difference_in_month - $deposit_times) * $interest_per_month;
				if ($sundry_amt < 0) {
					$sundry_amt = 0;
				}

				$loan_from_member_sundry_amt += $sundry_amt;


				$fdr[] = $fdr_info;
				$amt[] = $sundry_amt;

				$exist = 1;
			}

			if (!$exist) {

				$sundry['info'] = '';
				$sundry['amt'] = 0;
			} else {
				$sundry['info'] = $fdr;
				$sundry['amt'] = $amt;
			}
			$sundry['total_loan_from_member_sundry'] = $loan_from_member_sundry_amt;

			$sundry['total'] = $loan_from_member_sundry_amt;
			$sundry['exist'] = $exist;
			return $sundry;
		} else {
			return 0;
		}
	}
}
function sundry_withdraw($service_type = null)
{
	$date = Carbon\Carbon::now();
	$prev_month_first_date = $date->startOfMonth()->subMonth()->format('Y-m-d');
	$prev_month_first_date = Carbon\Carbon::createFromFormat('Y-m-d',  $prev_month_first_date);

	$prev_month_last_date = $date->endOfMonth()->format('Y-m-d');
	$prev_month_last_date = Carbon\Carbon::createFromFormat('Y-m-d',  $prev_month_last_date);

	if (!$service_type) {


		// =================  calculate sundry amount of fdr (ie. Loan from members sundry) ===============
		$loan_from_member_depo = SundryCalculation::where('fdr_id', '!=', null)->where('tx_type', 'deposit')->sum('submitted_amt');
		$loan_from_member_withd = SundryCalculation::where('fdr_id', '!=', null)->where('tx_type', 'withdraw')->sum('submitted_amt');

		$loan_from_member_withdrawable = $loan_from_member_depo - $loan_from_member_withd;
		$loan_from_member_withdrawable = $loan_from_member_withdrawable < 0 ? 0 : $loan_from_member_withdrawable;

		//============  Calculate sundry amount of double benifit  ===============
		$double_benifit_depo = SundryCalculation::where('double_benifit_id', '!=', null)->where('tx_type', 'deposit')->sum('submitted_amt');
		$double_benifit_withd = SundryCalculation::where('double_benifit_id', '!=', null)->where('tx_type', 'withdraw')->sum('submitted_amt');

		$double_benifit_withdrawable = $double_benifit_depo - $double_benifit_withd;
		$double_benifit_withdrawable = $double_benifit_withdrawable < 0 ? 0 : $double_benifit_withdrawable;
		// ========= calcuation of sundry amount of share ===========
		$share_depo = SundryCalculation::where('share_id', '!=', null)->where('tx_type', 'deposit')->sum('submitted_amt');
		$share_withd = SundryCalculation::where('share_id', '!=', null)->where('tx_type', 'withdraw')->sum('submitted_amt');

		$share_withdrawable = $share_depo - $share_withd;
		$share_withdrawable = $share_withdrawable < 0 ? 0 : $share_withdrawable;




		// ========= calcuation of sundry amount of savings ===========
		$savings_depo = SundryCalculation::where('savings_id', '!=', null)->where('tx_type', 'deposit')->sum('submitted_amt');
		$savings_withd = SundryCalculation::where('savings_id', '!=', null)->where('tx_type', 'withdraw')->sum('submitted_amt');

		$savings_withdrawable = $savings_depo - $savings_withd;
		$savings_withdrawable = $savings_withdrawable < 0 ? 0 : $savings_withdrawable;


		// ========= calcuation of sundry amount of dps ===========

		$dps_withdrawable = 0;
		$dps_info = DpsAccount::all();
		foreach ($dps_info as  $dps) {
			$id = $dps->id;
			$dps_depo = SundryCalculation::where('dps_id', $id)->where('tx_type', 'deposit')->sum('submitted_amt');
			$dps_withdraw = SundryCalculation::where('dps_id', $id)->where('tx_type', 'withdraw')->sum('submitted_amt');
			$withdrawable = $dps_depo - $dps_withdraw;
			if ($withdrawable > 0) {
				$dps_withdrawable += $withdrawable;
			}
		}


		$dps_withdrawable = $dps_withdrawable < 0 ? 0 : $dps_withdrawable;





		$sundry['dps_withdrawable'] =  $dps_withdrawable;
		$sundry['savings_withdrawable'] =  $savings_withdrawable;
		$sundry['share_withdrawable'] =  $share_withdrawable;
		$sundry['double_benifit_withdrawable'] =  $double_benifit_withdrawable;
		$sundry['loan_from_member_withdrawable'] =  $loan_from_member_withdrawable;

		return $sundry;
	} else {
		$exist = 0;
		if ($service_type == 'share') {
			$total_share_sundry = 0;
			$share_info = Member::all();
			foreach ($share_info as  $share) {
				$id = $share->id;
				$share_depo = SundryCalculation::where('share_id', $id)->where('tx_type', 'deposit')->sum('submitted_amt');
				$share_withdraw = SundryCalculation::where('share_id', $id)->where('tx_type', 'withdraw')->sum('submitted_amt');
				$share_withrawable = $share_depo - $share_withdraw;
				if ($share_withrawable > 0) {
					$info[] = $share;
					$sundry_amt[] = $share_withrawable;
					$total_share_sundry += $share_withrawable;
					$exist = 1;
				}
			}
			$sundry['total'] = $total_share_sundry;
			if ($share_withrawable > 0) {

				$sundry['info'] = $info;
				$sundry['amt'] = $sundry_amt;
			} else {
				$sundry['info'] = "Abul Khair Sohag";
				$sundry['amt'] = 'Abul Khair Sohag';
			}
			$sundry['exist'] = $exist;
			return $sundry;
		} elseif ($service_type ==  'dps') {
			$total_dps_sundry = 0;
			$dps_info = DpsAccount::all();
			foreach ($dps_info as  $dps) {
				$id = $dps->id;
				$dps_depo = SundryCalculation::where('dps_id', $id)->where('tx_type', 'deposit')->sum('submitted_amt');
				$dps_withdraw = SundryCalculation::where('dps_id', $id)->where('tx_type', 'withdraw')->sum('submitted_amt');
				$dps_withrawable = $dps_depo - $dps_withdraw;
				if ($dps_withrawable > 0) {
					$info[] = $dps;
					$sundry_amt[] = $dps_withrawable;
					$total_dps_sundry += $dps_withrawable;
					$exist = 1;
				}
			}

			if ($total_dps_sundry > 0) {

				$sundry['info'] = $info;
				$sundry['amt'] = $sundry_amt;
			} else {
				$sundry['info'] = "Abul Khair Sohag";
				$sundry['amt'] = 'Abul Khair Sohag';
			}
			$sundry['total'] = $total_dps_sundry;
			$sundry['exist'] = $exist;
			return $sundry;
		} elseif ($service_type ==  'savings') {
			$total_savings_sundry = 0;
			$savings_info = SavingsAccount::all();
			foreach ($savings_info as  $savings) {
				$id = $savings->id;
				$savings_depo = SundryCalculation::where('savings_id', $id)->where('tx_type', 'deposit')->sum('submitted_amt');
				$savings_withdraw = SundryCalculation::where('savings_id', $id)->where('tx_type', 'withdraw')->sum('submitted_amt');
				$savings_withrawable = $savings_depo - $savings_withdraw;
				if ($savings_withrawable > 0) {
					$info[] = $savings;
					$sundry_amt[] = $savings_withrawable;
					$total_savings_sundry += $savings_withrawable;
					$exist = 1;
				}
			}

			if ($savings_withrawable > 0) {

				$sundry['info'] = $info;
				$sundry['amt'] = $sundry_amt;
			} else {
				$sundry['info'] = "Abul Khair Sohag";
				$sundry['amt'] = 'Abul Khair Sohag';
			}
			$sundry['total'] = $total_savings_sundry;
			$sundry['exist'] = $exist;
			return $sundry;
		} elseif ($service_type ==  'double_benifit') {
			// Calculate sundry amount of double benifit
			$total_double_benifit_sundry = 0;
			$double_benifit_info = DoubleBenifitAccount::all();
			foreach ($double_benifit_info as  $double_benifit) {
				$id = $double_benifit->id;
				$double_benifit_depo = SundryCalculation::where('double_benifit_id', $id)->where('tx_type', 'deposit')->sum('submitted_amt');
				$double_benifit_withdraw = SundryCalculation::where('double_benifit_id', $id)->where('tx_type', 'withdraw')->sum('submitted_amt');
				$double_benifit_withrawable = $double_benifit_depo - $double_benifit_withdraw;
				if ($double_benifit_withrawable > 0) {
					$info[] = $double_benifit;
					$sundry_amt[] = $double_benifit_withrawable;
					$total_double_benifit_sundry += $double_benifit_withrawable;
					$exist = 1;
				}
			}

			if ($double_benifit_withrawable > 0) {

				$sundry['info'] = $info;
				$sundry['amt'] = $sundry_amt;
			} else {
				$sundry['info'] = "Abul Khair Sohag";
				$sundry['amt'] = 'Abul Khair Sohag';
			}
			$sundry['total'] = $total_double_benifit_sundry;
			$sundry['exist'] = $exist;
			return $sundry;
		} elseif ($service_type ==  'loan_from_member') {
			// calculate sundry amount of fdr (ie. Loan from members sundry)
			$total_fdr_sundry = 0;
			$fdr_info = FdrAccount::all();
			foreach ($fdr_info as  $fdr) {
				$id = $fdr->id;
				$fdr_depo = SundryCalculation::where('fdr_id', $id)->where('tx_type', 'deposit')->sum('submitted_amt');
				$fdr_withdraw = SundryCalculation::where('fdr_id', $id)->where('tx_type', 'withdraw')->sum('submitted_amt');
				$fdr_withrawable = $fdr_depo - $fdr_withdraw;
				if ($fdr_withrawable > 0) {
					$info[] = $fdr;
					$sundry_amt[] = $fdr_withrawable;
					$total_fdr_sundry += $fdr_withrawable;
					$exist = 1;
				}
			}

			if ($fdr_withrawable > 0) {

				$sundry['info'] = $info;
				$sundry['amt'] = $sundry_amt;
			} else {
				$sundry['info'] = "Abul Khair Sohag";
				$sundry['amt'] = 'Abul Khair Sohag';
			}
			$sundry['total'] = $total_fdr_sundry;
			$sundry['exist'] = $exist;

			return $sundry;
		} else {
			return 0;
		}
	}
}


function calculate_total_month($duration, $duration_type)
{
	$total_month = 0;
	if ($duration_type == 'Year') {
		$total_month = $duration * 12;
	} else {
		$total_month = $duration;
	}

	return $total_month;
}

function cash_in_hand($start_date, $end_date)
{
	$debit_amount = 0;
	$credit_amount = 0;

	$debit_amount = Transaction::where('type', 'debit')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
	$credit_amount = Transaction::where('type', 'credit')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');

	$cash_in_hand = $credit_amount - $debit_amount;

	return $cash_in_hand;
}

function profit_loss_calculation($start_date, $end_date)
{
	/* ===========    Now  Calculate  Income  ===============*/

	$loan_related_income = 0;
	$others_income = 0;
	$total_income = 0;
	$salary_exp  = 0;
	$interest_expense = 0;
	$others_expense = 0;
	$total_expense = 0;

	// calculate profit related income of loan
	$loan_model = LoanAccount::with('transactions')->get();
	foreach ($loan_model as  $loan_info) {

		$interest_amt = $loan_info->loan_amount * $loan_info->interest_rate / 100;

		$paid_amt_within_date = 0;
		$total_paid_amt = 0;

		// here we are going to calculate two paid amount one is the amount winthin the financial year and another the total paid amount untill the financial year ends

		foreach ($loan_info->transactions as $tx_info) {
			if ($tx_info->tx_type == 'loan repay' && strtotime($tx_info->tx_date) >= strtotime($start_date) && strtotime($tx_info->tx_date) <= strtotime($end_date)) {
				$paid_amt_within_date += $tx_info->grand_total_amt;
			}
			if ($tx_info->tx_type == 'loan repay' && strtotime($tx_info->tx_date) <= strtotime($end_date)) {
				$total_paid_amt += $tx_info->grand_total_amt;
			}
		}

		// if the inerest amount is greater than the total amount (ie total paid amount untill end date of financial year) then the profit of loan will be the paid amount within the financila year
		// else we have to calculate the interest amount
		if ($interest_amt >= $total_paid_amt) {
			$loan_related_income += $paid_amt_within_date;
		} else {
			// here the interest amount is less than or equal to  the total paid amount
			$paid_before_date = $total_paid_amt - $paid_amt_within_date;
			if ($paid_before_date < $interest_amt) {
				$this_year_interest_payment_due = $interest_amt - $paid_before_date;
				if ($paid_amt_within_date > $this_year_interest_payment_due) {
					$loan_related_income += $this_year_interest_payment_due;
				} else {
					$loan_related_income += $paid_amt_within_date;
				}
			}
		}
		$interest_amt = 0;
	}

	// calculate others income
	$others_income = Transaction::where('tx_type', 'income')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');

	$total_income = $loan_related_income * 1 + $others_income * 1;

	$income['Loan Related Income'] = $loan_related_income;
	$income['Others & Management Income'] = $others_income;
	$income['Total Income'] = $total_income;

	/* ===========    Now  Calculate  Expense  ===============*/

	// salary expense
	$salary_exp = PayrollTransaction::whereBetween('date_of_transaction', [$start_date, $end_date])->sum('amount');
	// others expense
	$others_expense = Transaction::where('tx_type', 'expense')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
	// now claculate interest expense










	// now calculate total expense
	$total_expense = $salary_exp + $interest_expense + $others_expense + $total_expense;

	$profit_loass_before_allocation = $total_income - $total_expense;

	$reserved_funding = $profit_loass_before_allocation * 15 / 100;
	$co_operative_development_funding = $profit_loass_before_allocation * 3 / 100;
	$ku_loan_funding = $profit_loass_before_allocation * 10 / 100;

	$net_profit_after_allocation = $profit_loass_before_allocation - ($reserved_funding + $co_operative_development_funding + $ku_loan_funding);

	$expense['Salary + Allowance'] = $salary_exp;
	$expense['Interest/Savings '] = $interest_expense;
	// $expense['Loan & Oters'] = $salary_exp;
	$expense['Others & Management Income'] = $others_expense;
	$expense['Total Expense'] = $total_expense;

	$before_allocation["Net Profit Loss Before Allocation"] = $profit_loass_before_allocation;
	$before_allocation["Net Total"] = $total_income;

	$allocation_calculation['Reserved Funding 15%'] = $reserved_funding;
	$allocation_calculation['Co-opreative Development Funding 3%'] = $co_operative_development_funding;
	$allocation_calculation['Ku-Loan Funding 10%'] = $co_operative_development_funding;

	$after_allocation["Net Profit After Allocation"] = $net_profit_after_allocation;
	$after_allocation["Previous Year's Profit"] = 0;
	$after_allocation["Current Year's Profit Distribution"] = 0;
	$after_allocation["Transaction To Residual Document"] = $net_profit_after_allocation;


	$result['incomes'] = $income;
	$result['expenses'] = $expense;
	$result['before_allcations'] = $before_allocation;
	$result['allocation_calculations'] = $allocation_calculation;
	$result['after_allocations'] = $after_allocation;


	return $result;
}

function trial_balance($start_date, $end_date, $prev_year_start_date = null, $prev_year_end_date = null)
{

	// calculating Total Credit
	$model = Transaction::where('type', 'credit')->whereBetween('tx_date', [$start_date, $end_date])->get();
	$credit['Cash In Hand'] = 0;
	$credit['Savings'] = 0;
	$credit['DPS'] = 0;
	$credit['Loan'] = 0;
	$credit['Double Benifit'] = 0;
	$credit['Loan From Member'] = 0;
	$credit['Share'] = 0;
	$credit['Sundry'] = 0;
	$credit['Income'] = 0;
	$credit['Bank Transaction'] = 0;
	$credit['Salary'] = 0;
	$credit['Expense'] = 0;
	$debit['Cash In Hand'] = 0;
	foreach ($model as  $value) {
		if ($value->savings_account_id) {
			$credit['Savings'] += $value->grand_total_amt;
			$debit['Cash In Hand'] += $value->grand_total_amt;
		} else if ($value->dps_account_id) {
			$credit['DPS'] += $value->grand_total_amt;
			$debit['Cash In Hand'] += $value->grand_total_amt;
		} else if ($value->loan_account_id) {
			$credit['Loan'] += $value->grand_total_amt;
			$debit['Cash In Hand'] += $value->grand_total_amt;
		} else if ($value->double_benifit_account_id) {
			$credit['Double Benifit'] += $value->grand_total_amt;
			$debit['Cash In Hand'] += $value->grand_total_amt;
		} else if ($value->fdr_account_id) {
			$credit['Loan From Member'] += $value->grand_total_amt;
			$debit['Cash In Hand'] += $value->grand_total_amt;
		} else if ($value->share_id) {
			$credit['Share'] += $value->grand_total_amt;
			$debit['Cash In Hand'] += $value->grand_total_amt;
		}
	}
	// calculation for sundry
	$credit['Sundry'] = Transaction::where('tx_type', 'sundry payment')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
	$debit['Cash In Hand'] += $credit['Sundry'];


	// calculation for income
	$credit['Income'] = Transaction::where('tx_type', 'income')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
	$debit['Cash In Hand'] += $credit['Income'];

	// calculation for bank transaction
	$credit['Bank Transaction'] = Transaction::where('tx_type', 'bank repay')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
	$debit['Cash In Hand'] += $credit['Bank Transaction'];


	/* =================    CALCULATING Debit     ================== */
	$model = Transaction::where('type', 'debit')->whereBetween('tx_date', [$start_date, $end_date])->get();

	$debit['Savings'] = 0;
	$debit['DPS'] = 0;
	$debit['Loan'] = 0;
	$debit['Double Benifit'] = 0;
	$debit['Loan From Member'] = 0;
	$debit['Share'] = 0;
	$debit['Sundry'] = 0;
	$debit['Income'] = 0;
	$debit['Salary'] = 0;
	$debit['Expense'] = 0;
	$debit['Bank Transaction'] = 0;

	foreach ($model as  $value) {
		if ($value->savings_account_id) {
			$debit['Savings'] += $value->grand_total_amt;
			$credit['Cash In Hand'] += $value->grand_total_amt;
		} else if ($value->dps_account_id) {
			$debit['DPS'] += $value->grand_total_amt;
			$credit['Cash In Hand'] += $value->grand_total_amt;
		} else if ($value->loan_account_id) {
			$debit['Loan'] += $value->grand_total_amt;
			$credit['Cash In Hand'] += $value->grand_total_amt;
		} else if ($value->double_benifit_account_id) {
			$debit['Double Benifit'] += $value->grand_total_amt;
			$credit['Cash In Hand'] += $value->grand_total_amt;
		} else if ($value->fdr_account_id) {
			$debit['Loan From Member'] += $value->grand_total_amt;
			$credit['Cash In Hand'] += $value->grand_total_amt;
		} else if ($value->share_id) {
			$debit['Share'] += $value->grand_total_amt;
			$credit['Cash In Hand'] += $value->grand_total_amt;
		}
	}
	// calculation for sundry
	$debit['Sundry'] = Transaction::where('tx_type', 'sundry repay')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
	$credit['Cash In Hand'] += $debit['Sundry'];


	// calculation for expense
	$debit['Expense'] = Transaction::where('tx_type', 'expense')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
	$credit['Cash In Hand'] += $debit['Expense'];

	// calculation for bank transaction
	$debit['Bank Transaction'] = Transaction::where('tx_type', 'bank payment')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
	$credit['Cash In Hand'] += $debit['Bank Transaction'];

	// calculation for Salary
	$debit['Salary'] = PayrollTransaction::whereBetween('created_at', [$start_date, $end_date])->sum('amount');
	$credit['Cash In Hand'] += $debit['Salary'];


	// ===============	Calculation for Opening balance	=============
	$opening['Savings'] = 0;
	$opening['DPS'] = 0;
	$opening['Loan'] = 0;
	$opening['Double Benifit'] = 0;
	$opening['Loan From Member'] = 0;
	$opening['Share'] = 0;
	$opening['Sundry'] = 0;
	$opening['Income'] = 0;
	$opening['Salary'] = 0;
	$opening['Expense'] = 0;
	$opening['Bank Transaction'] = 0;
	$opening['Cash In Hand'] = 0;

	$savings_credit = Transaction::where('tx_type', 'savings repay')->where('tx_date', '<', $start_date)->sum('grand_total_amt');
	$savings_debit = Transaction::where('tx_type', 'savings payment')->where('tx_date', '<', $start_date)->sum('grand_total_amt');
	$opening['Savings'] = $savings_credit - $savings_debit;


	$DPS_credit = Transaction::where('tx_type', 'dps payment')->where('tx_date', '<', $start_date)->sum('grand_total_amt');
	$DPS_debit = Transaction::where('tx_type', 'dps repay')->where('tx_date', '<', $start_date)->sum('grand_total_amt');
	$opening['DPS'] = $DPS_credit - $DPS_debit;

	$loan_credit = Transaction::where('tx_type', 'loan repay')->where('tx_date', '<', $start_date)->sum('grand_total_amt');
	$loan_debit = Transaction::where('tx_type', 'loan payment')->where('tx_date', '<', $start_date)->sum('grand_total_amt');
	$opening['Loan'] = $loan_credit - $loan_debit;


	$double_enifit_credit = Transaction::where('tx_type', 'double benifit repay')->where('tx_date', '<', $start_date)->sum('grand_total_amt');
	$double_enifit_debit = Transaction::where('tx_type', 'double benifit payment')->where('tx_date', '<', $start_date)->sum('grand_total_amt');
	$opening['Double Benifit'] = $double_enifit_credit - $double_enifit_debit;


	$loan_from_member_credit = Transaction::where('tx_type', 'fdr repay')->where('tx_date', '<', $start_date)->sum('grand_total_amt');
	$loan_from_member_debit = Transaction::where('tx_type', 'fdr payment')->where('tx_date', '<', $start_date)->sum('grand_total_amt');
	$opening['Loan From Member'] = $loan_from_member_credit - $loan_from_member_debit;


	$share_credit = Transaction::where('tx_type', 'share repay')->where('tx_date', '<', $start_date)->sum('grand_total_amt');
	$share_debit = Transaction::where('tx_type', 'share payment')->where('tx_date', '<', $start_date)->sum('grand_total_amt');
	$opening['Share'] = $share_credit - $share_debit;

	$sundry_credit = Transaction::where('tx_type', 'sundry repay')->where('tx_date', '<', $start_date)->sum('grand_total_amt');
	$sundry_debit = Transaction::where('tx_type', 'sundry payment')->where('tx_date', '<', $start_date)->sum('grand_total_amt');
	$opening['Sundry'] = $sundry_credit - $sundry_debit;

	$income_credit = Transaction::where('tx_type', 'income')->where('type', 'credit')->where('tx_date', '<', $start_date)->sum('grand_total_amt');
	$income_debit = 0;
	$opening['Income'] = $income_credit - $income_debit;

	$expense_credit = 0;
	$expense_debit = Transaction::where('tx_type', 'expense')->where('type', 'debit')->where('tx_date', '<', $start_date)->sum('grand_total_amt');
	$opening['Expense'] = $expense_credit - $expense_debit;
	// //////////////////////////////////////////////
	$salary_credit = 0;
	$salary_debit = PayrollTransaction::where('created_at', '<', $start_date)->sum('amount');;
	$opening['Salary'] = $salary_credit - $salary_debit;

	$bank_credit = Transaction::where('tx_type', 'bank repay')->where('tx_date', '<', $start_date)->sum('grand_total_amt');
	$bank_debit = Transaction::where('tx_type', 'bank payment')->where('tx_date', '<', $start_date)->sum('grand_total_amt');
	$opening['Bank Transaction'] = $bank_credit - $bank_debit;

	// calculating opening balance

	$opening['Cash In Hand'] = opening_balance($start_date);



	// ===============	Now Its Time To Calculate Total Value	============
	// total Credit Calculation
	$total_credit = 0;
	foreach ($credit as  $key => $value) {
		$total_credit += $value;
	}


	// total debit Calculation
	$total_debit = 0;
	foreach ($debit as  $key => $value) {
		$total_debit += $value;
	}

	// total opening balance calculation
	$total_opening = 0;
	foreach ($opening as  $key => $value) {
		$total_opening += $value;
	}



	$result['debit'] = $debit;
	$result['credit'] = $credit;
	$result['opening'] = $opening;
	$result['total_debit'] = $total_debit;
	$result['total_credit'] = $total_credit;


	return $result;
}
function opening_balance($start_date)
{
	$cash_in_hand_credit = Transaction::where('cash_in_hand', '1')->sum('grand_total_amt');

	$cash_in_hand_debit = Transaction::where('type', 'debit')->where('tx_date', '<=', $start_date)->sum('grand_total_amt');
	$model = Transaction::where('type', 'credit')->where('tx_date', '<=', $start_date)->get();
	foreach ($model as $value) {
		if ($value->loan_account_id) {
			$cash_in_hand_credit += $value->grand_total_amt;
		} else if ($value->fdr_account_id) {
			$cash_in_hand_credit += $value->grand_total_amt;
		} else {
			$cash_in_hand_credit += $value->grand_total_amt;
		}
	}

	return  $cash_in_hand_credit - $cash_in_hand_debit;
}


// Sadik Work Start
// find employee designation name useing employee id
function employee_designation($employee_id)
{
	$designation_description = EmployeeDesignation::where('employee_id', $employee_id)->first();
	if ($designation_description) {
		$designation_id = $designation_description->designation_id;
		$find_designation = Designation::where('id', $designation_id)->first();
		if ($find_designation) {
			$designation = $find_designation->name;
		} else {
			$designation = '';
		}
	} else {
		$designation = '';
	}

	return $designation;
}

// find employee name using employee id

function find_employee_name_using_employee_id($employee_id)
{
	$employee  = Employee::where('id', $employee_id)->first();

	if ($employee) {

		$name = $employee->name;
	} else {

		$name = '';
	}

	return $name;
}

// find employee salary structure  earning total using employee id
function find_employee_earning_salary_using_employee_id($employee_id, $payroll_id)
{

	$emp_salary = EmployeeSalary::where('employee_id', $employee_id)->where('id', $payroll_id)->first();

	if ($emp_salary) {

		$earning = $emp_salary->total_earning;
	} else {

		$earning = 0;
	}

	return $earning;
}

// find employee salary structure  deduction total using employee id
function find_employee_deduction_salary_using_employee_id($employee_id, $payroll_id)
{

	$emp_salary = EmployeeSalary::where('employee_id', $employee_id)->where('id', $payroll_id)->first();

	if ($emp_salary) {

		$earning = $emp_salary->total_deduction;
	} else {

		$earning = 0;
	}

	return $earning;
}

// find employee total salary structure  deduction total using employee id
function find_employee_total_salary_using_employee_id($employee_id, $payroll_id)
{

	$emp_salary = EmployeeSalary::where('employee_id', $employee_id)->where('id', $payroll_id)->first();

	if ($emp_salary) {

		$earning = $emp_salary->net_salary;
	} else {

		$earning = 0;
	}

	return $earning;
}

// find employee department name using employee id
function employee_department($employee_id)
{
	$designation_description = EmployeeDesignation::where('employee_id', $employee_id)->first();
	if ($designation_description) {
		$department_id = $designation_description->department_id;
		$find_department = Department::where('id', $department_id)->first();
		if ($find_department) {
			$department = $find_department->name;
		} else {
			$department = '';
		}
	} else {
		$department = '';
	}

	return $department;
}

// total_advance_payment using employee id
function total_advance_payment($employee_id)
{
	$total = PayrollTransaction::where('employee_id', $employee_id)->where('tx_type', 'Advance Payment')->sum('amount');
	return $total;
}

// total_advance_return using employee id
function total_advance_return($employee_id)
{
	$total = PayrollTransaction::where('employee_id', $employee_id)->where('tx_type', 'Advance Return')->sum('amount');
	return $total;
}
