<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <ul class="nav menu">
        <li class="{{ Request::is('/*') ? 'active' : '' }}"><a href="/"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
        <li class="{{ Request::is('proposals*') ? 'active' : '' }}"><a href="proposals"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg>Proposal</a></li>
        <li class="{{ Request::is('theses*') ? 'active' : '' }}"><a href="charts.html"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg>Tesis</a></li>
    </ul>
</div><!--/.sidebar-->