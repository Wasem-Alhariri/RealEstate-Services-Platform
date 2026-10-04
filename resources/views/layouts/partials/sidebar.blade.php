@php
    $menuData = [json_decode(file_get_contents(resource_path('menu/verticalMenu.json')))];
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard-analytics') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <div class="d-flex align-items-center justify-content-center bg-primary rounded p-2 text-white">
                    <i class='bx bx-buildings fs-4'></i>
                </div>
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2 text-primary fs-5" style="letter-spacing: -0.5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ __('dashboard.title') ?? 'Real Estate' }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @foreach ($menuData[0]->menu as $menu)
            @php
                $hasPermission = true;
                if (isset($menu->permission)) {
                    $hasPermission = auth()->user()->can($menu->permission);
                }
            @endphp

            @if ($hasPermission)
                @if (isset($menu->menuHeader))
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">{{ __('sidebar.' . $menu->menuHeader) ?? $menu->menuHeader }}</span>
                    </li>
                @else
                    @php
                        $activeClass = '';
                        $currentRouteName = Route::currentRouteName() ?? '';
                        $isOpen = '';

                        if (is_array($menu->slug)) {
                            foreach($menu->slug as $slug){
                                if (str_starts_with($currentRouteName, $slug)) {
                                    $activeClass = 'active';
                                    $isOpen = isset($menu->submenu) ? 'open' : '';
                                    break;
                                }
                            }
                        } else {
                            if (str_starts_with($currentRouteName, $menu->slug)) {
                                $activeClass = 'active';
                                $isOpen = isset($menu->submenu) ? 'open' : '';
                            }
                        }

                        // Fix URL generation for parent items and javascript:void(0)
                        $menuUrl = 'javascript:void(0);';
                        if (!isset($menu->submenu) && isset($menu->url)) {
                            $menuUrl = $menu->url === 'javascript:void(0);' ? 'javascript:void(0);' : url($menu->url);
                        }
                    @endphp

                    <li class="menu-item {{ $activeClass }} {{ $isOpen }}">
                        <a href="{{ $menuUrl }}" class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}">
                            @isset($menu->icon)
                                <i class="{{ $menu->icon }} menu-icon"></i>
                            @endisset
                            <div data-i18n="{{ $menu->name }}">{{ __('sidebar.' . $menu->name) ?? $menu->name }}</div>
                        </a>

                        {{-- Submenu logic --}}
                        @if (isset($menu->submenu))
                            <ul class="menu-sub">
                                @foreach ($menu->submenu as $submenu)
                                    @php
                                        $hasSubPermission = true;
                                        if (isset($submenu->permission)) {
                                            $hasSubPermission = auth()->user()->can($submenu->permission);
                                        }
                                    @endphp

                                    @if($hasSubPermission)
                                        @php
                                            $subActiveClass = '';
                                            if (is_array($submenu->slug)) {
                                                foreach($submenu->slug as $subslug){
                                                    if (str_starts_with($currentRouteName, $subslug)) {
                                                        $subActiveClass = 'active';
                                                        break;
                                                    }
                                                }
                                            } else {
                                                if (str_starts_with($currentRouteName, $submenu->slug)) {
                                                    $subActiveClass = 'active';
                                                }
                                            }
                                            
                                            $subMenuUrl = 'javascript:void(0);';
                                            if (isset($submenu->url)) {
                                                $subMenuUrl = $submenu->url === 'javascript:void(0);' ? 'javascript:void(0);' : url($submenu->url);
                                            }
                                        @endphp

                                        <li class="menu-item {{ $subActiveClass }}">
                                            <a href="{{ $subMenuUrl }}" class="menu-link">
                                                <div data-i18n="{{ $submenu->name }}">{{ __('sidebar.' . $submenu->name) ?? $submenu->name }}</div>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endif
            @endif
        @endforeach
    </ul>
</aside>
