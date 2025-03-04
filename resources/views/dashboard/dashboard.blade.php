@extends('layouts.headerSidebar')

@section('title')
    Dashboard
@endsection

@push('css')
  <link rel="stylesheet" href="{{asset('assets/backend/css/dashboard.css')}}">
@endpush

@section('content')
  <div class="dashboard-section">
    <div class="row">
      <div class="col-12">
        <div class="dashboard-content">
          <div class="row">
            <div class="col-3">
              <div class="card radius-15 bg-voilet">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <h2 class="mb-0 text-white">{{$articleShow}} <i class="fa-solid fa-arrow-up font-14 text-white"></i></h2>
                    </div>
                    <div class="ms-auto font-35 text-white">
                      <i class="fa-solid fa-newspaper"></i>
                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div>
                      <p class="mb-0 text-white">Articles Show</p>
                    </div>
                    <div class="ms-auto font-14 text-white">+{{$percentageArticleShow}}%</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="card radius-15 bg-primary-blue">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <h2 class="mb-0 text-white">{{$articlePending}} <i class="fa-solid fa-arrow-down font-14 text-white"></i></h2>
                    </div>
                    <div class="ms-auto font-35 text-white">
                      <i class="fa-solid fa-download"></i>
                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div>
                      <p class="mb-0 text-white">Articles Request</p>
                    </div>
                    <div class="ms-auto font-14 text-white">+{{$percentageArticlePending}}%</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="card radius-15 bg-rose">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <h2 class="mb-0 text-white">{{$rejectedArticle}} <i class="fa-solid fa-arrow-up font-14 text-white"></i></h2>
                    </div>
                    <div class="ms-auto font-35 text-white">
                      <i class="fa-solid fa-ban"></i>
                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div>
                      <p class="mb-0 text-white">Cancelled Articles</p>
                    </div>
                    <div class="ms-auto font-14 text-white">-{{$percentageRejectedArticle}}%</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="card radius-15 bg-sunset">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <h2 class="mb-0 text-white">{{$pendingUsersCount}} <i class="fa-solid fa-arrow-down font-14 text-white"></i></h2>
                    </div>
                    <div class="ms-auto font-35 text-white"><i class="fa-regular fa-user"></i>
                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div>
                      <p class="mb-0 text-white">New Users</p>
                    </div>
                    <div class="ms-auto font-14 text-white">+{{$percentagePendingUsers}}%</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="aticle-chart radius-15 py-4 my-4">
                <div id="articleChart"></div>
              </div>
            </div>
            <div class="col-6">
              <div class="pending-user radius-15 px-3 pt-3">
                <h5 class="mb-2">Rejected Users to Access</h5>
                <table class="table table-striped table-hover">
                  <thead class="table-dark">
                    <tr>
                      <th scope="col" class="text-center">Image</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($pendingUsers as $user)
                      <tr>
                        <td class="text-center"><img src="{{$user->image_url ??''}}" class="rounded-circle" alt="User Image" height="40" width="40"></td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td class="text-center text-nowrap">
                          
                          @can('view',$user)
                            <a class="btn btn-outline-primary btn-sm" href="{{route('user.show',$user->id)}}">
                              <i class="fa-solid fa-eye"></i>
                            </a>
                          @else
                            <button type="button" class="btn btn-outline-primary btn-sm disabled" aria-disabled="true">
                              <i class="fa-solid fa-eye"></i>
                            </button>
                          @endcan

                          @can('approved',$user)
                            <a class="approved btn btn-outline-success btn-sm" data-id="{{ $user->id ??''}}"">
                              <i class="fa-solid fa-check"></i>
                            </a>
                          @else
                            <button type="button" class="btn btn-outline-success btn-sm disabled" aria-disabled="true">
                              <i class="fa-solid fa-check"></i>
                            </button>
                          @endcan

                          @can('delete',$user)
                            <a class="remove btn btn-outline-danger btn-sm" data-id="{{ $user->id ??''}}">
                              <i class="fa-solid fa-trash"></i>
                            </a>
                          @else
                            <button type="button" class="btn btn-outline-danger btn-sm disabled" aria-disabled="true">
                              <i class="fa-solid fa-trash"></i>
                            </button>
                          @endcan
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="">
                  {{$pendingUsers->links()}}
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="user-chart radius-15 py-4">
                <div id="userChart"></div>
              </div>
            </div>
            <div class="col-12">
              <div class="country-chart radius-15 py-4 my-4">
                <div id="countryChart"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Appreved Modal Start-->
  <div class="modal fade" id="approvedModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Approved Conformation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-1">
                    <h4 class="mb-1">Are you sure you want to approved this user ?</h4>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="approvedBtn">Yes, Approved It!</button>
            </div>
        </div>
    </div>
</div>
<!-- Appreved Modal End-->

<!-- Delete Modal Start-->
<div class="modal fade" id="removeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Conformation</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="mt-1">
                  <h4 class="mb-1">Are you sure you want to remove this Users?</h4>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="delete">Yes, Delete It!</button>
          </div>
      </div>
  </div>
</div>
<!-- Delete Modal End-->

@endsection

@push('script')

  {{-- HIGHCHART JS CDN LINK  --}}
  <script src="https://code.highcharts.com/highcharts.js"></script>
  {{-- <script src="https://code.highcharts.com/modules/accessibility.js"></script> --}}


  {{-- APPROVED MODAL AJAX SCRIPT --}}
  <script>
    $(document).ready(function () {
      $('.approved').on('click', function () {
        let id = $(this).data('id'); 
        $('#approvedModal').modal('show'); 

        $('#approvedBtn').off('click').on('click', function () {
          $.ajax({
              url: "{{ route('user.approved', ':id') }}".replace(':id', id),
              type: "get",
              data: {
                  
              },
              success: function (response) {
                  // toastr.success(response.success);
                  $('#approvedModal').modal('hide'); 
                  location.reload(); 
              },
              error: function (xhr) {
                  // toastr.error("Something went wrong!"); 
              }
          });
        });
      });
    });
  </script>

  {{-- DELETE MODAL AJAX SCRIPT --}}
  <script>
    $(document).ready(function () {
      $('.remove').on('click', function () {
        let id = $(this).data('id'); 
        $('#removeModal').modal('show'); 

        $('#delete').off('click').on('click', function () {
          $.ajax({
            url: "{{ route('user.delete', ':id') }}".replace(':id', id),
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                _method: "DELETE" 
            },
            success: function (response) {
                // toastr.success(response.success);
                $('#removeModal').modal('hide'); 
                location.reload(); 
            },
            error: function (xhr) {
                // toastr.error("Something went wrong!"); 
            }
          });
        });
      });
    });
  </script>

  {{-- ARTICLE CHART JS CODE HERE  --}}
  <script type="text/javascript">
    // Last 30 days data
    var last30DaysKeys = @json(array_keys($articleChart['last_30_days']));
    var last30DaysValues = @json(array_values($articleChart['last_30_days']));

    // Previous 30 days data
    var previous30DaysKeys = @json(array_keys($articleChart['previous_30_days']));
    var previous30DaysValues = @json(array_values($articleChart['previous_30_days']));

    // Unique categories for x-axis
    var categories = [...new Set([...last30DaysKeys, ...previous30DaysKeys])];

    Highcharts.chart('articleChart', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Article Count in Last 30 Days vs Previous 30 Days'
      },
      xAxis: {
        categories: categories,
        crosshair: true,
        title: {
            text: 'Categories'
        }
      },
      yAxis: {
        min: 0,
        title: {
            text: 'Number of Articles'
        }
      },
      tooltip: {
        shared: true,
        valueSuffix: ' articles'
      },
      plotOptions: {
        column: {
          pointPadding: 0.2,
          borderWidth: 0
        }
      },
      series: [
        {
          name: 'Last 30 Days',
          data: categories.map(cat => last30DaysKeys.includes(cat) ? last30DaysValues[last30DaysKeys.indexOf(cat)] : 0),
          color: '#007bff'
        },
        {
          name: 'Previous 30 Days',
          data: categories.map(cat => previous30DaysKeys.includes(cat) ? previous30DaysValues[previous30DaysKeys.indexOf(cat)] : 0),
          color: '#ff5733'
        }
      ]
    });
  </script>

  {{-- USER REGISTRASION CHART  --}}
  <script type="text/javascript">

    var dataKeys = @json(array_keys($usersChart));
    var dataValues = @json(array_values($usersChart));

    Highcharts.chart('userChart', {
      chart: {
          type: 'column'
      },
      title: {
          text: 'User Registration in this Year'
      },
      xAxis: {
        categories: dataKeys,
        crosshair: true,
        title: {
            text: 'Month'
        }
      },
      yAxis: {
          min: 0,
          title: {
              text: 'Number of Users Register'
          }
      },
      tooltip: {
          valueSuffix: ' (1000 MT)'
      },
      plotOptions: {
          column: {
              pointPadding: 0.2,
              borderWidth: 0
          }
      },
      series: [
        {
            name: 'Users Register',
            data: dataValues
        }
      ]
    });
  </script>

  <script>
    (async () => {

    const data = await fetch(
        'https://www.highcharts.com/samples/data/usdeur.json'
    ).then(response => response.json());

    Highcharts.chart('countryChart', {
        chart: {
            zooming: {
                type: 'x'
            }
        },
        title: {
            text: 'Article Engeged By Location'
        },
        subtitle: {
            text: document.ontouchstart === undefined ?
                'Click and drag in the plot area to zoom in' :
                'Pinch the chart to zoom in'
        },
        xAxis: {
            type: 'datetime'
        },
        yAxis: {
            title: {
                text: 'Exchange rate'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            area: {
                marker: {
                    radius: 2
                },
                lineWidth: 1,
                color: {
                    linearGradient: {
                        x1: 0,
                        y1: 0,
                        x2: 0,
                        y2: 1
                    },
                    stops: [
                        [0, 'rgb(199, 113, 243)'],
                        [0.7, 'rgb(76, 175, 254)']
                    ]
                },
                states: {
                    hover: {
                        lineWidth: 1
                    }
                },
                threshold: null
            }
        },

        series: [{
            type: 'area',
            name: 'USD to EUR',
            data: data
        }]
    });
    })();
  </script>

@endpush