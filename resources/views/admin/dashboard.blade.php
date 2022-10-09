<x-app-layout title="Dashboard Admin">
    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
        <script src={{ asset('assets/demo/chart-area-demo.js') }}></script>
        <script src={{ asset('assets/demo/chart-bar-demo.js') }}></script>
        <script src={{ asset('assets/demo/chart-pie-demo.js') }}></script>
        <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
        <script src={{ asset('js/litepicker.js') }}></script>
    @endpush
    <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
        <div class="me-4 mb-3 mb-sm-0">
            <h1 class="mb-0">Dashboard</h1>
            <div class="small">
                <span class="fw-500 text-primary">Friday</span>
                &middot; September 20, 2021 &middot; 12:16 PM
            </div>
        </div>
        <!-- Date range picker example-->
        <div class="input-group input-group-joined border-0 shadow" style="width: 16.5rem">
            <span class="input-group-text"><i data-feather="calendar"></i></span>
            <input class="form-control ps-0 pointer" id="litepickerRangePlugin" placeholder="Select date range..." />
        </div>
    </div>
    <!-- Illustration dashboard card example-->
    <div class="card card-waves mb-4 mt-5">
        <div class="card-body p-5">
            <div class="row align-items-center justify-content-between">
                <div class="col">
                    <h2 class="text-primary">Welcome back, your dashboard is ready!</h2>
                    <p class="text-gray-700">Great job, your affiliate dashboard is ready to go! You can view sales,
                        generate links, prepare coupons, and download affiliate reports using this dashboard.</p>
                    <a class="btn btn-primary p-3" href="#!">
                        Get Started
                        <i class="ms-1" data-feather="arrow-right"></i>
                    </a>
                </div>
                <div class="col d-none d-lg-block mt-xxl-n4"><img class="img-fluid px-xl-4 mt-xxl-n5"
                        src={{ asset('assets/img/illustrations/statistics.svg') }} /></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <!-- Dashboard info widget 1-->
            <div class="card border-start-lg border-start-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small fw-bold text-primary mb-1">Earnings (monthly)</div>
                            <div class="h5">$4,390</div>
                            <div class="text-xs fw-bold text-success d-inline-flex align-items-center">
                                <i class="me-1" data-feather="trending-up"></i>
                                12%
                            </div>
                        </div>
                        <div class="ms-2"><i class="fas fa-dollar-sign fa-2x text-gray-200"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <!-- Dashboard info widget 2-->
            <div class="card border-start-lg border-start-secondary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small fw-bold text-secondary mb-1">Average sale price</div>
                            <div class="h5">$27.00</div>
                            <div class="text-xs fw-bold text-danger d-inline-flex align-items-center">
                                <i class="me-1" data-feather="trending-down"></i>
                                3%
                            </div>
                        </div>
                        <div class="ms-2"><i class="fas fa-tag fa-2x text-gray-200"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <!-- Dashboard info widget 3-->
            <div class="card border-start-lg border-start-success h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small fw-bold text-success mb-1">Clicks</div>
                            <div class="h5">11,291</div>
                            <div class="text-xs fw-bold text-success d-inline-flex align-items-center">
                                <i class="me-1" data-feather="trending-up"></i>
                                12%
                            </div>
                        </div>
                        <div class="ms-2"><i class="fas fa-mouse-pointer fa-2x text-gray-200"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <!-- Dashboard info widget 4-->
            <div class="card border-start-lg border-start-info h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small fw-bold text-info mb-1">Conversion rate</div>
                            <div class="h5">1.23%</div>
                            <div class="text-xs fw-bold text-danger d-inline-flex align-items-center">
                                <i class="me-1" data-feather="trending-down"></i>
                                1%
                            </div>
                        </div>
                        <div class="ms-2"><i class="fas fa-percentage fa-2x text-gray-200"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 mb-4">
            <!-- Illustration card example-->
            <div class="card mb-4">
                <div class="card-body text-center p-5">
                    <img class="img-fluid mb-5" src={{ asset('assets/img/illustrations/data-report.svg') }} />
                    <h4>Report generation</h4>
                    <p class="mb-4">Ready to get started? Let us know now! It's time to start building that dashboard
                        you've been waiting to create!</p>
                    <a class="btn btn-primary p-3" href="#!">Continue</a>
                </div>
            </div>
            <!-- Report summary card example-->
            <div class="card mb-4">
                <div class="card-header">Affiliate Reports</div>
                <div class="list-group list-group-flush small">
                    <a class="list-group-item list-group-item-action" href="#!">
                        <i class="fas fa-dollar-sign fa-fw text-blue me-2"></i>
                        Earnings Reports
                    </a>
                    <a class="list-group-item list-group-item-action" href="#!">
                        <i class="fas fa-tag fa-fw text-purple me-2"></i>
                        Average Sale Price
                    </a>
                    <a class="list-group-item list-group-item-action" href="#!">
                        <i class="fas fa-mouse-pointer fa-fw text-green me-2"></i>
                        Engagement (Clicks &amp; Impressions)
                    </a>
                    <a class="list-group-item list-group-item-action" href="#!">
                        <i class="fas fa-percentage fa-fw text-yellow me-2"></i>
                        Conversion Rate
                    </a>
                    <a class="list-group-item list-group-item-action" href="#!">
                        <i class="fas fa-chart-pie fa-fw text-pink me-2"></i>
                        Segments
                    </a>
                </div>
                <div class="card-footer position-relative border-top-0">
                    <a class="stretched-link" href="#!">
                        <div class="text-xs d-flex align-items-center justify-content-between">
                            View More Reports
                            <i class="fas fa-long-arrow-alt-right"></i>
                        </div>
                    </a>
                </div>
            </div>
            <!-- Progress card example-->
            <div class="card bg-primary border-0">
                <div class="card-body">
                    <h5 class="text-white-50">Budget Overview</h5>
                    <div class="mb-4">
                        <span class="display-4 text-white">$48k</span>
                        <span class="text-white-50">per year</span>
                    </div>
                    <div class="progress bg-white-25 rounded-pill" style="height: 0.5rem">
                        <div class="progress-bar bg-white w-75 rounded-pill" role="progressbar" aria-valuenow="75"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 mb-4">
            <!-- Area chart example-->
            <div class="card mb-4">
                <div class="card-header">Revenue Summary</div>
                <div class="card-body">
                    <div class="chart-area"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <!-- Bar chart example-->
                    <div class="card h-100">
                        <div class="card-header">Sales Reporting</div>
                        <div class="card-body d-flex flex-column justify-content-center">
                            <div class="chart-bar"><canvas id="myBarChart" width="100%" height="30"></canvas>
                            </div>
                        </div>
                        <div class="card-footer position-relative">
                            <a class="stretched-link" href="#!">
                                <div class="text-xs d-flex align-items-center justify-content-between">
                                    View More Reports
                                    <i class="fas fa-long-arrow-alt-right"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Pie chart example-->
                    <div class="card h-100">
                        <div class="card-header">Traffic Sources</div>
                        <div class="card-body">
                            <div class="chart-pie mb-4"><canvas id="myPieChart" width="100%"
                                    height="50"></canvas></div>
                            <div class="list-group list-group-flush">
                                <div
                                    class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                    <div class="me-3">
                                        <i class="fas fa-circle fa-sm me-1 text-blue"></i>
                                        Direct
                                    </div>
                                    <div class="fw-500 text-dark">55%</div>
                                </div>
                                <div
                                    class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                    <div class="me-3">
                                        <i class="fas fa-circle fa-sm me-1 text-purple"></i>
                                        Social
                                    </div>
                                    <div class="fw-500 text-dark">15%</div>
                                </div>
                                <div
                                    class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                    <div class="me-3">
                                        <i class="fas fa-circle fa-sm me-1 text-green"></i>
                                        Referral
                                    </div>
                                    <div class="fw-500 text-dark">30%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
