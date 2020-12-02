<div class="container">
    <nav class="nav-menu mobile-menu">
        <ul>
                @php
                    $menu1 = $Menu->menu1();
                    $menu2 = $Menu->menu2();
                @endphp
                @foreach($menu1 as $row1)
                <li><a href="{{URL::to('cat/'.$row1->TenLH_KhongDau)}}">{{ $row1->TenLH }}</a>
                    <ul class="dropdown">
                    @php
                        $menu1_2 = $menu2->where('MaLH', '=', $row1->MaLH);
                    @endphp
                    @foreach($menu1_2 as $row2)
                        <li><a href="{{URL::to('type/'.$row2->TenPL_KhongDau)}}">{{ $row2->TenPL }}</a></li>
                    @endforeach
                    </ul>
                </li>
                @endforeach
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
</div>
