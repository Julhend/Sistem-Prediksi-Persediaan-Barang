<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('/uploads/settings/'.$logo) }}" style="width: 200px;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ auth()->user()->image_path }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('moderator.profile') }}" class="d-block">{{ auth()->user()->first_name }}
                    {{ auth()->user()->last_name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}"
                        class="nav-link {{ (request()->segment(2) == 'dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @lang('site.dashboard')
                        </p>
                    </a>
                </li>
                @if (auth()->user()->hasPermission('read_categories'))
                <li class="nav-item">
                    <a href="{{ url('/category') }}" class="nav-link
                       {{ (request()->segment(2) == 'category') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            @lang('site.categories')
                        </p>
                    </a>
                </li>
                @endif
                @if (auth()->user()->hasPermission('read_products'))
                <li class="nav-item">
                    <a href="{{ url('/product') }}"
                        class="nav-link {{ (request()->segment(2) == 'product') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            @lang('site.products')
                        </p>
                    </a>
                </li>
                @endif
                @if (auth()->user()->hasPermission('read_sales'))
                <li class="nav-item">
                    <a href="{{ url('/sale') }}"
                        class="nav-link {{ (request()->segment(2) == 'sale') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cart-plus"></i>
                        <p>
                            @lang('site.sales')
                        </p>
                    </a>
                </li>
                @endif
                @if (auth()->user()->hasPermission('read_purchases'))
                <li class="nav-item">
                    <a href="{{ url('/purchase') }}"
                        class="nav-link {{ (request()->segment(2) == 'purchase') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>
                            @lang('site.purchases')
                        </p>
                    </a>
                </li>
                @endif
                @if (auth()->user()->hasPermission('read_providers'))
                <li class="nav-item">
                    <a href="{{ url('/provider') }}"
                        class="nav-link {{ (request()->segment(2) == 'provider') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>
                            @lang('site.providers')
                        </p>
                    </a>
                </li>
                @endif
                @if (auth()->user()->hasPermission('read_clients'))
                <li class="nav-item">
                    <a href="{{ url('/client') }}"
                        class="nav-link {{ (request()->segment(2) == 'client') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            @lang('site.clients')
                        </p>
                    </a>
                </li>
                @endif
                {{-- //read_prediksi --}}
                @if (auth()->user()->hasPermission('read_clients'))
                <li class="nav-item">
                    <a href="{{ url('/prediksi') }}"
                        class="nav-link {{ (request()->segment(2) == 'prediksi') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-compass"></i>
                        <p>
                            @lang('site.prediksi')
                        </p>
                    </a>
                </li>
                @endif
                @if (auth()->user()->hasPermission('read_generalsetting'))
                <li class="nav-item">
                    <a href="{{ url('/generalsetting')  }}"
                        class="nav-link {{ (request()->segment(2) == 'generalsetting') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            @lang('site.settings')
                        </p>
                    </a>
                </li>
                @endif
            </ul>
            </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>