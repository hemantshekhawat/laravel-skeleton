@layout('layouts.main')
@section('content')
<? //echo __('user.user_not_activated');?>
<?if ($errors->has('user_alert'))
{
	$alert_message = $errors->first('user_alert');
	$alert_type =  ($errors->has('alert_type')) ? $errors->first('alert_type') : Alert::INFO;
	echo Alert::show($alert_type, $alert_message)->block();
}
?>
<? echo Former::horizontal_open()
  ->id('MyForm')
  ->secure()
  ->rules(array('email' => 'required|email', 'password' => 'required'))
  ->method('POST');?>
{{Former::token();}}
{{Former::text("email", "Email")->appendIcon('envelope')}}
@if (isset($is_forgotten))
{{\Former::actions (Former::primary_submit('Reset Password'))}}
@else
{{Former::password("password", "Password")->appendIcon('aw_key')}}
<? echo \Former::actions (
    Former::primary_submit('Login'),
    HTML::link('/login/forgotten', 'Forgot your password?', array('style'=>'padding:20px'))
  );?>
@endif
{{Former::close()}}
@endsection