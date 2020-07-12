@extends('page')


@section('header','User')
@section('subheader','List User')

@can('user.create')
@section('add-button-url', '/user/add')
@section('add-button-text', 'Add User')
@endcan

@section('content')
<table id="user-table" class="table table-bordered table-striped" style="width: 100%">
    <thead>
        <tr>
            @canany(['user.update', 'user.delete'])
            <th class="no-sort" width="135px">Action</th>
            @endcanany
            <th>Name</th>
            <th>Username</th>
            <th>Role</th>
            <th>Email</th>
            <th class="no-sort">Status</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>



@endsection
  <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@section('add_css')

@endsection
@section('add_js')
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
    $(function () {
        $('#user-table').DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            dom: `<'row'<'col-sm-12 col-md-12'f>>
                        <'row'<'col-sm-12'tr>>
                        <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-9'p>>>>`,
      
            ajax: '{{ URL::to('/') }}/user/data',
            columns: [
                @canany(['user.update', 'user.delete'])
                {data: 'id', name: 'id',  
                    render: function(data, type, row){
                        var button = "";
                        @can('user.update')
                        button += '<a href="{{ URL::to('/') }}/user/edit/'+row.id+'" class="btn btn-sm btn-outline-info" style="white-space: nowrap"><i class="fas fa-edit"></i>Edit</a>&nbsp;&nbsp;';
                        @endcan
                        @can('user.delete')
                        button += '<a href="{{ URL::to('/') }}/user/delete/'+row.id+'" class="btn btn-sm btn-outline-danger" style="white-space: nowrap"><i class="fas fa-trash"></i>Delete</a>';
                        @endcan
                        return button;
                    }
                },
                @endcanany
                {data: 'name', name: 'name'},
                {data: 'username', name: 'username'},
                {data: 'role_name', name: 'role_name'},
                {data: 'email', name: 'email'},
                {data: 'is_active', 
                    render: function(data, type, row){
                        if(row.is_active == 1){
                            return 'Active';
                        }
                        return 'Inactive';
                    }
                }
            ],
            columnDefs: [
                {
                    "targets": 'no-sort',
                    "orderable": false,
                },
                {
                    targets: 'hidden',
                    visible: false,
                }
            ],
            initComplete: function (settings, json) {
                $('.no-sort').removeClass('sorting_asc');
            }
        });
        
    });
</script>
@endsection