@extends('page')


@section('header','Role')
@section('subheader','List Role')

@section('add-button-url', '/role/add')
@section('add-button-text', 'Add Role')

@section('content')
<table id="role-table" class="table table-bordered table-striped" style="width: 100%">
    <thead>
        <tr>
            <th class="no-sort">Action</th>
            <th>Name</th>
            <th>Permissions</th>
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
        $('#role-table').DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            dom: `<'row'<'col-sm-12 col-md-12'f>>
                        <'row'<'col-sm-12'tr>>
                        <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-9'p>>>>`,
      
            ajax: '{{ URL::to('/') }}/role/data',
            columns: [
                {data: 'id', name: 'id',  
                    render: function(data, type, row){
                        return '<a href="{{ URL::to('/') }}/role/edit/'+row.id+'" class="btn btn-sm btn-outline-info" style="white-space: nowrap"><i class="fas fa-edit"></i>Edit</a>';
                    }
                },
                {data: 'name', name: 'name'},
                {data: 'permissions', name: 'permissions',
                    render: function(data){
                        return data;
                    }
                },
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