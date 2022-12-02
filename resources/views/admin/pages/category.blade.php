@extends('admin.index')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>
          All Category /
          <a href="{{ url('/admin/add-new') }}" class=" badge badge-sl text-secondary font-weight-bold  bg-gradient-info text-white" data-toggle="tooltip" data-original-title="Edit user">
            Add New
          </a>
        </h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Number</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantity</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th class="text-secondary opacity-7"></th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1;
              ?>
              @foreach ($cate as $cate_item )
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div class="align-middle text-center">
                      <h6 class="mb-0 text-sm">{{ $i++ }}</h6>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-l font-weight-bold mb-0">{{ $cate_item->category_name }}</p>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-l font-weight-bold">{{ $cate_item->books_count }}</span>
                </td>
                <td class="align-middle text-center text-sm">
                  @if ($cate_item->category_status == 0)
                    <span class="badge badge-sm bg-gradient-success"><a class="text-white" href="{{ url('/category-offline/'.$cate_item->category_id) }}">Online</a></span>
                  @else
                  <span class="badge badge-sm bg-gradient-danger"><a class="text-white" href="{{ url('/category-online/'.$cate_item->category_id) }}">Offline</a></span>
                  @endif
                </td>
                <td class="align-middle">
                  <a href="javascript:;" class=" badge badge-sl text-secondary font-weight-bold text-l bg-gradient-info text-white" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                </td>
                <td class="align-middle">
                  <a href="{{ url('/delete-category/'.$cate_item->category_id) }}" class="badge badge-sm bg-gradient-danger text-white text-secondary font-weight-bold text-l " data-toggle="tooltip" data-original-title="Edit user">
                    Delete
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@if(session('status'))
    <div id="alert" class="alert alert-success col-md-6 float-right">
        {{ session('status')}}
    </div>
@endif

<script type="text/javascript">
  const myTimeout = setTimeout(myGreeting, 2000);

  function myGreeting() {
    try {
      document.getElementById("alert").remove();
    } catch (error) {
      
    }
  }
</script>
@endsection