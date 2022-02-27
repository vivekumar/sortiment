@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container-full">

<!-- Main content -->
<section class="content">
<style>
    .form-horizontal .form-label {
        text-align: right;
    }
</style>
<!-- Basic Forms -->
 <div class="box">
   <div class="box-header with-border">
     <h2 class="box-title">{{__('Default Messages')}}</h2>
     <div class="pull-right">
       <button type="submit" class="btn btn-success" id="butoon-form" form="form-default-message" data-toggle="tooltip" title="Save">
           <i class="fa fa-save"></i>
       </button>
       <a  id="butoon-cacnel" class="btn btn-primary" href="{{ route('admin.default.message') }}" data-toggle="tooltip" title="Cancel">
            <i class="fa fa-reply"></i>
       </a>
     </div>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
    <form class="ibox-body form-horizontal" id="form-default-message" action="{{ $form['action'] }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="mb-3 row">
            <label class="form-label col-sm-3" for="input-message">{{__('Message')}}</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="message" placeholder="Message" value="{{ $form['message'] }}" required>
                @if (!empty($form['errors']['message']))
                    <div class="text-danger">{{ $form['errors']['message'] }}</div>
                @endif
            </div>
        </div>
        <div class="mb-3 row">
            <label class="form-label col-sm-3" for="input-link">{{__('Link')}}</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="link" placeholder="Link" value="{{ $form['link'] }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label class="form-label col-sm-3">{{__('Status')}}</label>
            <div class="col-sm-9">
                <div class="form-check form-check-inline">
                    @if ($form['status'] == 1)
                        <input id="input-status" name="status" class="form-check-input" type="checkbox" data-toggle="toggle" data-style="mr-1" checked value="1">
                        <label for="input-status" class="form-check-label">{{__('Enabled')}}</label>
                    @else
                        <input id="input-status" name="status" class="form-check-input" type="checkbox" data-toggle="toggle" data-style="mr-1" value="0">
                        <label for="input-status" class="form-check-label">{{__('Disabled')}}</label>
                    @endif
                </div>
            </div>
        </div>
    </form>
   </div>
   <!-- /.box-body -->
 </div>
 <!-- /.box -->

</section>
<!-- /.content -->
</div>
<script>
    (() => {
        let input_status = document.getElementById('input-status');
        input_status.addEventListener('change', (event) => {
            if (input_status.checked) {
                document.querySelector('label[for="input-status"]').innerHTML = 'Enabled';
                input_status.value = 1;
            } else {
                document.querySelector('label[for="input-status"]').innerHTML = 'Disabled';
                input_status.value = 0;
            }
        })
    })();
</script>
@endsection
