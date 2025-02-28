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
                <h5 class="mb-2">Pending Users to Access</h5>
                <table class="table table-striped table-hover">
                  <thead class="table-dark">
                    <tr>
                      <th scope="col">Image</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($pendingUsers as $user)
                      <tr>
                        <td><img src="{{$user->image_url ??''}}" class="rounded-circle" alt="User Image" height="40" width="40"></td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td  style="white-space: nowrap;">
                          <a href="" class="btn btn-outline-success btn-sm">
                            <i class="fa-solid fa-check"></i>
                          </a>
                          <a href="" class="btn btn-outline-danger btn-sm">
                            <i class="fa-solid fa-trash"></i>
                          </a>
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
@endsection

@push('script')
  {{-- HIGHCHART JS CDN LINK  --}}
  <script src="https://code.highcharts.com/highcharts.js"></script>


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