<div class="flex-shrink-0 p-3">
    <div class="d-flex align-items-center pb-3 mb-3 link-body-emphasis text-decoration-none border-bottom">
        <span class="fs-5 fw-semibold text-white pe-none">
            <i class="bi bi-list"></i>
            فهرست
        </span>
    </div>
    <!------------------------------ داشبورد----------------------------->
    <ul class="list-unstyled pe-0">
        <li class="mb-1">
            <a href="{{ route('dashboard') }}"
                class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white"
                aria-expanded="false">
                <i class="bi bi-house ms-1"></i>داشبورد
            </a>
        </li>
        <!------------------------------ کاربران----------------------------->
        @if(Auth::user()->role == 'admin')
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white"
                data-bs-toggle="collapse" data-bs-target="#users-collapse" aria-expanded="false">
                <i class="bi bi-person ms-1"></i> کاربران

            </button>

            <div class="collapse" id="users-collapse" style="">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{ route('users.index') }}"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                class="bi bi-chevron-left"></i>همه</a>
                    </li>

                    <li><a href="{{ route('users.create') }}"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                class="bi bi-chevron-left"></i>ایجاد</a></li>
                </ul>
            </div>
        </li>

        <li class="mb-1">
            <a href="{{ route('change-password') }}"
                class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white"
                aria-expanded="false">
                <i class="bi bi-lock ms-1"></i>تغییر رمز عبور
            </a>
        </li>
        @endif


        <!------------------------------ دانشکده----------------------------->
        @if(Auth::user()->role == 'admin')

        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white"
                data-bs-toggle="collapse" data-bs-target="#collage-collapse" aria-expanded="false">
                <i class="bi bi-option ms-1"></i>
                دانشکده
            </button>
            <div class="collapse" id="collage-collapse" style="">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{ route('colleges.index') }}"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                class="bi bi-chevron-left"></i>همه</a></li>
                    <li><a href="{{ route('colleges.create') }}"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                class="bi bi-chevron-left"></i>ایجاد</a></li>
                </ul>
            </div>
        </li>
        @endif
        <!----------------------------- ترم ها----------------------------->
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'educational_supervisor')
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white"
                data-bs-toggle="collapse" data-bs-target="#terms-collapse" aria-expanded="false">
                <i class="bi bi-calendar ms-1"></i>
                ترم ها
            </button>
            <div class="collapse" id="terms-collapse" style="">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{ route('terms.index') }}"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                class="bi bi-chevron-left"></i>همه</a></li>
                    <li><a href="{{ route('terms.create') }}"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                class="bi bi-chevron-left"></i>ایجاد</a></li>
                </ul>
            </div>
        </li>
        @endif

        <!------------------------------ دروس----------------------------->
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'educational_supervisor' || Auth::user()->role ==
        'faculty_head' || Auth::user()->role == 'professor')

        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white"
                data-bs-toggle="collapse" data-bs-target="#lessons-collapse" aria-expanded="false">
                <i class="bi bi-book ms-1"></i>
                دروس
            </button>
            <div class="collapse" id="lessons-collapse" style="">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{ route('lessons.index') }}"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                class="bi bi-chevron-left"></i>همه</a></li>
                    @endif
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'faculty_head')
                    <li><a href="{{ route('lessons.create') }}"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                class="bi bi-chevron-left"></i>ایجاد</a></li>
                    @endif
                </ul>
            </div>
        </li>

        <!------------------------------  اساتید----------------------------->
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'educational_supervisor' || Auth::user()->role ==
        'faculty_head' || Auth::user()->role == 'professor')

        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white"
                data-bs-toggle="collapse" data-bs-target="#professors-collapse" aria-expanded="false">
                <i class="bi bi-people ms-1"></i>
                اساتید
            </button>
            <div class="collapse" id="professors-collapse" style="">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{ route('professors.index') }}"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                class="bi bi-chevron-left"></i>همه</a></li>
                    @endif
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'faculty_head')

                    <li><a href="{{ route('professors.create') }}"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                class="bi bi-chevron-left"></i>افزودن</a></li>
                    @endif
                </ul>
            </div>
        </li>
        <!------------------------------زمان بندی----------------------------->
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'educational_supervisor' || Auth::user()->role ==
        'faculty_head')

        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white"
                data-bs-toggle="collapse" data-bs-target="#time-periods-collapse" aria-expanded="false">
                <i class="bi bi-clock ms-1"></i>
                زمان بندی
            </button>
            <div class="collapse" id="time-periods-collapse" style="">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{ route('time-periods.index') }}"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                class="bi bi-chevron-left"></i>همه</a></li>
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'educational_supervisor')
                    <li><a href="{{ route('time-periods.create') }}"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                class="bi bi-chevron-left"></i>ایجاد</a></li>
                </ul>
                @endif
            </div>
        </li>
        @endif
        <!------------------------------     گروه های آموزشی----------------------------->
        @if(Auth::user()->role == 'admin' )

        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white"
                data-bs-toggle="collapse" data-bs-target="#eg-collapse" aria-expanded="false">
                <i class="bi bi-mortarboard ms-1"></i>
                گروه های آموزشی
            </button>
            <div class="collapse" id="eg-collapse" style="">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{ route('educational-groups.index') }}"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                class="bi bi-chevron-left"></i>همه</a></li>
                    @if(\Illuminate\Support\Facades\Auth::user()->role !== 3)
                    <li><a href="{{ route('educational-groups.create') }}"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                class="bi bi-chevron-left"></i>ایجاد</a></li>
                    @endif
                </ul>
            </div>
            @endif
            <!------------------------------ ورودی ها----------------------------->
            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'educational_supervisor' || Auth::user()->role ==
            'faculty_head' || Auth::user()->role == 'professor')

        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white"
                data-bs-toggle="collapse" data-bs-target="#entries-collapse" aria-expanded="false">
                <i class="bi bi-calendar-date ms-1"></i>
                ورودی ها
            </button>
            <div class="collapse" id="entries-collapse" style="">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{ route('entries.index') }}"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                class="bi bi-chevron-left"></i>همه</a></li>
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'educational_supervisor' )
                    <li><a href="{{ route('entries.create') }}"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                class="bi bi-chevron-left"></i>ایجاد</a></li>
                    @endif
                </ul>
            </div>
        </li>
        @endif
        <!------------------------------   کلاس ها---------------------------->
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'faculty_head' || Auth::user()->role == 'professor')

            <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white"
                    data-bs-toggle="collapse" data-bs-target="#class-collapse" aria-expanded="false">
                    <i class="bi bi-easel ms-1"></i>
                    کلاس ها
                </button>
                <div class="collapse" id="class-collapse" style="">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="{{ route('classrooms.index') }}"
                                class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                    class="bi bi-chevron-left"></i>جدول کلاس ها</a></li>
                        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'educational_supervisor' || Auth::user()->role == 'faculty_head')

                            <li><a href="{{ route('classrooms.create') }}"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                        class="bi bi-chevron-left"></i>تعریف کلاس</a></li>
                        @endif
                    </ul>
                </div>
            </li>
        @endif
        <!------------------------------   مکان کلاس ها--------------------------->
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'faculty_head'  )

        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white"
                data-bs-toggle="collapse" data-bs-target="#location-collapse" aria-expanded="false">
                <i class="bi bi-pin-map ms-1"></i>
                مکان کلاس ها
            </button>
            <div class="collapse" id="location-collapse" style="">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{ route('locations.index') }}"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                class="bi bi-chevron-left"></i>همه</a></li>
                    <li><a href="{{ route('locations.create') }}"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                class="bi bi-chevron-left"></i>ایجاد</a></li>
                    <li><a href="{{ route('locations.determine') }}"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white text-nowrap my-2"><i
                                class="bi bi-chevron-left"></i>تعیین مکان کلاس ها</a></li>
                </ul>
            </div>
        </li>
        @endif



        <!-- Add other educational supervisor menu items here -->



   <!------------------------------  گزارش گیری------------------------->
   @if(Auth::user()->role == 'admin' || Auth::user()->role == 'educational_supervisor' || Auth::user()->role =='faculty_head' || Auth::user()->role == 'professor')

<li class="mb-1">
    <a href="{{ route('schedule.index') }}"
        class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white"
        aria-expanded="false">
        <i class="bi bi-filetype-pdf ms-1"></i>
        گزارش گیری
    </a>
</li>
@endif



        <!------------------------------    حضور غیاب-------------------------->

        <li class="mb-1">
            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'educational_supervisor' || Auth::user()->role == 'faculty_head' || Auth::user()->role == 'professor')
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white"
                    data-bs-toggle="collapse" data-bs-target="#presenceAndAbsence-collapse" aria-expanded="false">
                    <i class="bi bi-card-checklist ms-1"></i>
                    حضور غیاب
                </button>
            @endif

            <div class="collapse" id="presenceAndAbsence-collapse" style="">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'faculty_head')
                        <li>
                            <a href="{{ route('p-a.index') }}"
                                class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2">
                                <i class="bi bi-chevron-left"></i>جدول هفتگی
                            </a>
                        </li>
                    @endif

                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'educational_supervisor' || Auth::user()->role == 'professor' || Auth::user()->role == 'faculty_head')
                        <li>
                            <a href="{{ route('p-a.history') }}"
                                class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2">
                                <i class="bi bi-chevron-left"></i>گزارش گیری تاریخچه
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>


     
        <!------------------------------  حساب------------------------>

        <li class="border-top my-3"></li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-white"
                data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                <i class="bi bi-person"></i>حساب
            </button>
            <div class="collapse" id="account-collapse" style="">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{ route('change-password') }}"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                class="bi bi-lock"></i>تغییر رمز عبور</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded text-white my-2"><i
                                class="bi bi-door-open"></i>خروج</a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>