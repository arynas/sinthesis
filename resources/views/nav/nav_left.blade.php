<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <ul class="nav menu">
        <li class="{{ Request::is('/*') ? 'active' : '' }}"><a href="/"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
         @if(Auth::user()->role == 'administrator')
            <li class="{{ Request::is('proposals*') ? 'active' : '' }}"><a href="/proposals"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg>Proposal</a></li>
            <li class="{{ Request::is('theses*') ? 'active' : '' }}"><a href="/theses"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg>Tesis</a></li>
         @elseif(Auth::user()->role == 'student')
            <li class="{{ Request::is('theses*') ? 'active' : '' }}"><a href="/theses"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg>Tesis</a></li>
            <li class="{{ Request::is('conselings*') ? 'active' : '' }}"><a href="/conselings"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg>Bimbingan</a></li>
            <li class="{{ Request::is('schedules*') ? 'active' : '' }}"><a href="/schedules"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>Jadwal</a></li>
        @elseif(Auth::user()->role == 'lecturer')
            <li class="{{ Request::is('conselings*') ? 'active' : '' }}"><a href="/conselings"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg>Bimbingan</a></li>
            <li class="{{ Request::is('schedules*') ? 'active' : '' }}"><a href="/schedules"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>Jadwal</a></li>
        @endif
    </ul>
</div><!--/.sidebar-->