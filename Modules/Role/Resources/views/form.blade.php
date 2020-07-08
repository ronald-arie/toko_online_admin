@extends('page')


@section('header','Role')
@section('subheader','Add Role')


@section('content')
<form class="form" method="post" >
    <input required type="hidden" name="id" value="{{ @$id }}">
    <input required type="hidden" name="_token" value="{{ csrf_token() }}">
    <!-- <div class="card-body"> -->
        {{ $Form->setErrors($errors) }}
        {{ $Form->setColLabel(3) }}
        {{ $Form->input('name') }}
        {{ $Form->input('is_active') }}
        @foreach (config('permissions.permissions') as $key => $value)
        {{ $Form->input("permissions[$key]") }}
        @endforeach
    <!-- </div> -->
    <!-- <div class="card-footer"> -->
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    <!-- </div> -->
</form>



@endsection
@section('add_css')

@endsection
@section('add_js')
<script>
    $(function () {
        {{ $Form->printJs()}}
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
                        return '<a href="{{ URL::to('/') }}/role/'+row.id+'" class="btn btn-sm btn-outline-info" style="white-space: nowrap"><i class="fas fa-edit"></i>Edit</a>';
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