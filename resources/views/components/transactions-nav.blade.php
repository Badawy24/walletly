<div class="card border-0 mb-4" style="background: white;">
    <div class="card-body p-2">
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('expenses.*') ? 'active' : '' }}"
                   href="{{ route('expenses.index') }}"
                   style="{{ request()->routeIs('expenses.*') ? 'background: var(--danger-bg) !important; color: white !important;' : '' }}">
                    📉 Expenses
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('deposits.*') ? 'active' : '' }}"
                   href="{{ route('deposits.index') }}"
                   style="{{ request()->routeIs('deposits.*') ? 'background: var(--success-bg) !important; color: white !important;' : '' }}">
                    📈 Deposits
                </a>
            </li>
        </ul>
    </div>
</div>
