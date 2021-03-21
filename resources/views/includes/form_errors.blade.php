@if(Session::has('Error'))
<h2 class="alert alert-danger text-center">{{session('Error')}}</h2>
@elseif(Session::has('success'))
<h2 class="alert alert-success text-center">{{session('success')}}</h2>
@endif