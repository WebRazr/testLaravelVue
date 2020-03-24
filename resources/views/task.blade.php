@extends('layouts.app')

@section('content')


@if($authMain)
<div>
<modal-forma @upd-arr="updarr"></modal-forma>
<test_comp :todos="todos" @upd-arr="updarr"></test_comp> 
</div>
@else
<div style="width: 100%">
    <p style="margin-left: 80px; font-size: 4em">для создания своего списка задач авторизуйтесь</p>
</div>
@endif

@endsection  