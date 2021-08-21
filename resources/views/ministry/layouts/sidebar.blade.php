<div class="sidebar" data-active-color="rose" data-background-color="black" data-image="{{ asset('assets') }}/img/sidebar-1.jpg">
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            XU
        </a>
        <a href="#" class="simple-text logo-normal">
            Giáo vụ
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{ asset('assets') }}/img/default-avatar.png" />
            </div>
            <div class="info">
                <a href="#" class="collapsed">
                    <span>
                        {{ Session::get('name') }}
                    </span>
                </a>
                <div class="clearfix"></div>
            </div>
        </div>
        <ul class="nav">
            <li>
                <a href="{{ route('dashboard') }}" class="dashboard">
                    <i class="material-icons">dashboard</i>
                    <p> Dashboard </p>
                </a>
            </li>
            <li>
                <a href="" class="assignment">
                    <i class="material-icons">assignment</i>
                    <p> Phân công </p>
                </a>
            </li>
            <li>
                <a href="{{ route('studentList') }}" class="student">
                    <i class="material-icons">manage_accounts</i>
                    <p> Danh sách sinh viên </p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#class">
                    <i class="material-icons">class</i>
                    <p>Quản lý lớp học
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="class">
                    <ul class="nav">
                        <li>
                            <a href="{{ route('classList') }}" class="class">
                                <span class="sidebar-mini"><i class="material-icons">school</i></span>
                                <span class="sidebar-normal">Danh sách lớp học</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('courseMajorList') }}" class="major">
                                <span class="sidebar-mini"><i class="material-icons">article</i></span>
                                <span class="sidebar-normal">Niên khóa và Chuyên ngành</span>
                            </a>
                        </li>
                        <li>
                            <a href="" class="subject">
                                <span class="sidebar-mini"><i class="material-icons">subject</i></span>
                                <span class="sidebar-normal">Môn học</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#staff">
                    <i class="material-icons">card_travel</i>
                    <p>Danh sách cán bộ
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="staff">
                    <ul class="nav">
                        <li>
                            <a href="{{ route('ministryList') }}" class="ministry">
                                <span class="sidebar-mini"><i class="material-icons">admin_panel_settings</i></span>
                                <span class="sidebar-normal">Giáo vụ</span>
                            </a>
                        </li>
                        <li>
                            <a href="" class="teacher">
                                <span class="sidebar-mini"><i class="material-icons">attribution</i></span>
                                <span class="sidebar-normal">Giảng viên</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
