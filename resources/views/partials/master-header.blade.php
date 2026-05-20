<div class="card shadow-sm border-0 mb-4">

    <div class="card-body py-2">

        <ul class="nav nav-pills">

            <li class="nav-item me-2">

                <a href="{{ route('plot-rates.index') }}"
                    class="nav-link {{ request()->routeIs('plot-rates.*') ? 'active bg-success' : 'text-dark border' }}">

                    <i class="bi bi-graph-up me-1"></i>
                    Plot Rate

                </a>

            </li>


            <li class="nav-item me-2">

                <a href="{{ route('plc-rates.index') }}"
                    class="nav-link {{ request()->routeIs('plc-rates.*') ? 'active bg-success' : 'text-dark border' }}">

                    <i class="bi bi-percent me-1"></i>
                    PLC Rate

                </a>

            </li>


            <li class="nav-item">

                <a href="{{ route('developments.index') }}"
                    class="nav-link {{ request()->routeIs('developments.*') ? 'active bg-success' : 'text-dark border' }}">

                    <i class="bi bi-buildings me-1"></i>
                    Development

                </a>

            </li>

        </ul>

    </div>

</div>
