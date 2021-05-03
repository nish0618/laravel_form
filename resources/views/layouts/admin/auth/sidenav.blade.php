<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="text-center">
        <a href="#" class="brand-link">
            <span class="brand-text text-light font-weight-light">
                <b>管理画面</b>
            </span>
        </a>
    </div>

    <div class="sidebar">
        <nav class="mt-5">
            <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu">
                <li class="nav-header text-muted">Dashboard</li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.apply.index') }}">
                        <i class="fal fa-clipboard-list fa-fw mr-2"></i>
                        <p>応募者リスト</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.deadline.index') }}">
                        <i class="fal fa-clipboard-list fa-fw mr-2"></i>
                        <p>終了日時設定リスト</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.login_history.index') }}">
                        <i class="fal fa-clipboard-list fa-fw mr-2"></i>
                        <p>管理画面ログイン履歴</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
