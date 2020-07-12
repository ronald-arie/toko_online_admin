@extends('page')


@section('header','User')
@section('subheader','Add User')


@section('content')
<form class="form" method="post" >
    <input required type="hidden" name="id" value="{{ @$id }}">
    <input required type="hidden" name="_token" value="{{ csrf_token() }}">
        {{ $Form->setErrors($errors) }}
        {{ $Form->setColLabel(3) }}
        {{ $Form->input('name') }}
        {{ $Form->input('username') }}
        {{ $Form->input('password') }}
        {{ $Form->input('email') }}
        {{ $Form->input('role_id') }}
        {{ $Form->input('is_active') }}
        <button type="submit" class="btn btn-primary float-right">Submit</button>
</form>



@endsection
@section('add_css')

@endsection
@section('add_js')
<script>
    $(function () {
        {{ $Form->printJs()}}
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
                {data: 'id', name: 'id',  
                    render: function(data, type, row){
                        return '<a href="{{ URL::to('/') }}/user/'+row.id+'" class="btn btn-sm btn-outline-info" style="white-space: nowrap"><i class="fas fa-edit"></i>Edit</a>';
                    }
                },
                {data: 'name', name: 'name'},
                {data: 'permissions', name: 'permissions'},
                {data: 'status', name: 'status', 
                    render: function(data, type, row){
                        if(row.status == 1){
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