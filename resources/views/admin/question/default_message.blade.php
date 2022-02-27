@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container-full">

<!-- Main content -->
<section class="content">
<!-- Basic Forms -->
 <div class="box">
   <div class="box-header with-border">
     <h2 class="box-title">{{__('Default Messages')}}</h2>
     <div class="pull-right">
       <a href="{{ url('admin/default-message/add') }}" class="btn btn-primary" data-toggle="tooltip" title="Add New Default Message">
        <i class="fa fa-plus-circle"></i>
      </a>
     </div>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
     <table class="table table-bordered table-hover">
       <thead>
         <tr>
           <th>{{__('S.No.')}}</th>
           <th>{{__('Message')}}</th>
           <th>{{__('Link')}}</th>
           <th>{{__('Status')}}</th>
           <th class="text-right">{{__('Action')}}</th>
         </tr>
       </thead>
       <tbody>
        @foreach($messages as $sn => $message)
          <tr>
            <td>{{ $sn + 1 }}.</td>
            <td>{{ $message->message }}</td>
            <td>{{ $message->link }}</td>
            <td>{{ $message->status == 1 ? 'Enabled' : 'Disabled' }}</td>
            <td class="text-right">
              <a href="{{ url('admin/default-message/edit', $message->id) }}" class="btn btn-primary" data-toggle="tooltip" title="Edit">
                <i class="fa fa-edit"></i>
              </a>
              <a href="{{ url('admin/default-message/delete', $message->id) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger" data-toggle="tooltip" title="Delete">
                <i class="fa fa-trash"></i>
              </a>
            </td>
          </tr>
        @endforeach
       </tbody>
     </table>
   </div>
   <!-- /.box-body -->
 </div>
 <!-- /.box -->

</section>
<!-- /.content -->
</div>
@endsection
