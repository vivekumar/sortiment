@extends('employee.main_master')
@section('content')
<style>
    .btn {
        font-size: 1rem;
        padding: 6px 13px;
    }
</style>
    <div class="products-con1 ask-qus-wrap d-flex">
        {{--<table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Admin</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($admins as $sn => $admin)
                <tr>
                    <td>{{ $sn + 1 }} .</td>
                    <td>{{ $admin->name }}</td>
                    <td class="text-end">
                        <a href="{{ url('employee/aska-question/chat', $admin->id) }}" class="btn btn-primary" data-toggle="tooltip" title="Ask Question">
                            <i class="fa fa-question-circle"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
                <tr>
                    <td>{{ '2' }} .</td>
                    <td>{{ \App\Models\User::where('id',Auth::user()->user_id)->value('company') }}</td>
                    <td class="text-end">
                        <a href="{{ url('employee/aska-question/chat-company', Auth::user()->user_id) }}" class="btn btn-primary" data-toggle="tooltip" title="Ask Question">
                            <i class="fa fa-question-circle"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>--}}
    </div>
@endsection
@section('js')
<script src="//code.tidio.co/fxsq3xegsxcnpbjz8zc2tyf7dupmouha.js" async></script>

@endsection