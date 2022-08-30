@extends('layouts.app', [
'class' => '',
'elementActive' => 'safari_portal'
])

@section('content')
<style>
    .loader {
        border: 16px solid #f3f3f3;
        /* Light grey */
        border-top: 16px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .page_header_right_container{
        position: absolute;
        top: 0;
        right: 0;
        z-index: 6;
        width: 100%;
    }

    .page_header_right_sub_container{
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 1.5rem;
        height: 3.2rem;
        background: #fff;
        border-bottom: 1px solid #f3f3f3;
    }

    .page_header_left_child{    
        z-index: 4;
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .page_header_left_child_menu{    
        margin: 0 18px 0 8px;
        text-transform: capitalize;
        font-weight: 420;
        font-style: normal;
        font-size: 14px;
        font-family: "Brandon","Arial",sans-serif;
        line-height: 20px;
        letter-spacing: .651429px;
        color: #3e3e40;
    }

    .page_header_right_child{
        display: flex;
        flex-basis: 100%;
        align-items: center;
        justify-content: space-between;
    }

    ::-webkit-scrollbar {
        width: 8px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        -webkit-border-radius: 8px;
        background: #f1f1f1; 
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        -webkit-border-radius: 5px;
        border-radius: 5px;
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
    background: #555; 
    }

    .table_contents_hide{
        display:none;
    }

    .table_contents_show{
        z-index:99;
    }

</style>
<div class="content" id="content-container" style="position:relative">
    <div class="container-fluid mt--7">
        <div id="loader-container" style="position:absolute; top:50%; left:50%; transform:translate(50%,50%)"></div>
    </div>
</div>
<div class="row no-gutters" style="overflow-y:auto" id="div_main_row" hidden>
    <!-- <div class="col-lg-6 col-xs-12 col-sm-6"></div>
    <div class="col-lg-6 col-xs-12 col-sm-6">
        
    </div> -->
    <div id="id_table_contents" style="position:fixed;" class="table_contents_hide">
        <div class="col-lg-6 col-xs-12 col-sm-6">
            <div style="position: absolute;top: 0; right:0;transition-duration: .5s; width:25rem;background: #252321;">
                <div>
                    <div class="text-uppercase" style="margin: 3.7rem 0 2rem 2rem;font-weight: 800;font-size: 24px;font-family: Brandon;line-height: 130%;color: #ffffff;background: linear-gradient(180deg,#252321,rgba(37,35,33,.6));">Table of Contents</div>
                    <ul class="text-uppercase" style="color:#c4c4c4; list-style-type:none;font-size:16px;font-family: Brandon;font-weight: 420;line-height: 23px; letter-spacing: .242033px;  overflow-y: auto;height: 91vh;padding-bottom: 5rem;margin-right: 10px;">
                        @foreach ($pages as $key_pages => $value_pages)
                            @if ($value_pages['role'] == "cover_page")
                                <li style="margin-bottom:20px; cursor:pointer" >
                                    <i class="fa fa-minus"></i>
                                    Cover Page
                                </li>
                            @else
                                <li style="margin-bottom:20px;cursor:pointer"><i class="fa fa-minus"></i>
                                    <?php echo str_replace('"',"",html_entity_decode(json_encode($value_pages['headline']))); ?>
                                    <br>
                                    @if (!is_null($value_pages['dates_range']['start']) && !is_null($value_pages['dates_range']['end']))
                                        @if (date('F', strtotime($value_pages['dates_range']['start'])) == date('F', strtotime($value_pages['dates_range']['end'])))
                                        <span style="font-size:17px; font-style:italic; text-transform:none; font-family: Hoefler;">
                                            {{ date('F', strtotime($value_pages['dates_range']['start'])) . ' ' . date('d', strtotime($value_pages['dates_range']['start'])) }}
                                            -
                                            {{ date('d', strtotime($value_pages['dates_range']['end'])). ', '.date('Y', strtotime($value_pages['dates_range']['end'])) }}</span>
                                        @else
                                        <span style="font-size:17px; font-style:italic; text-transform:none; font-family: Hoefler;">
                                            {{ date('F', strtotime($value_pages['dates_range']['start'])) . ' ' . date('d', strtotime($value_pages['dates_range']['start'])) }}
                                            -
                                            {{ date('F', strtotime($value_pages['dates_range']['end'])) . ' ' . date('d', strtotime($value_pages['dates_range']['end'])). ', '.date('Y', strtotime($value_pages['dates_range']['end'])) }}</span>
                                        @endif
                                    @elseif (!is_null($value_pages['dates_range']['start']) && is_null($value_pages['dates_range']['end']))
                                        <span style="font-size:17px; font-style:italic; text-transform:none; font-family: Hoefler;">
                                        {{ date('F', strtotime($value_pages['dates_range']['start'])) . ' ' . date('d', strtotime($value_pages['dates_range']['start'])). ', '.date('Y', strtotime($value_pages['dates_range']['end'])) }}</span>
                                    @else
                                       
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12 col-sm-6"></div>
    </div>
    @foreach ($data as $key_main => $value_main)
        @foreach ($pages as $key_pages => $value_pages)
        <div id="left-{{($key_pages+1)}}" class="col-lg-6 col-xs-12 col-sm-6">
            <!-- Table of Contents  remove filter:brightness(75%)-->
            <div style="position: relative;text-align: left;">
                <div>
                    <ul style="position: absolute; top: 25px; left: 15px; color: white;list-style-type: none;">
                        <li>
                            @if ($value_pages['subheadline'] != '')
                            <span style="width: 100%;font-size:20px; font-family:Brandon;color: white; font-style:italic"><i
                                    class="fa fa-minus"></i>
                                {{$value_pages['subheadline']}}</span><br>
                            @else
                                @if (!is_null($value_pages['dates_range']['start']) && !is_null($value_pages['dates_range']['end']))
                                    @if (date('F', strtotime($value_pages['dates_range']['start'])) == date('F', strtotime($value_pages['dates_range']['end'])))
                                    <span style="width: 100%;font-size:20px; font-family:Brandon;color: white; font-style:italic">
                                        <i class="fa fa-minus"></i>
                                        {{ date('F', strtotime($value_pages['dates_range']['start'])) . ' ' . date('d', strtotime($value_pages['dates_range']['start'])) }}
                                        -
                                        {{ date('d', strtotime($value_pages['dates_range']['end'])) }}</span>
                                    @else
                                    <span style="width: 100%;font-size:20px; font-family:Brandon;color: white; font-style:italic">
                                        <i class="fa fa-minus"></i>
                                        {{ date('F', strtotime($value_pages['dates_range']['start'])) . ' ' . date('d', strtotime($value_pages['dates_range']['start'])) }}
                                        -
                                        {{ date('F', strtotime($value_pages['dates_range']['end'])) . ' ' . date('d', strtotime($value_pages['dates_range']['end'])) }}</span>
                                    @endif
                                @elseif (!is_null($value_pages['dates_range']['start']) && is_null($value_pages['dates_range']['end']))
                                    <span style="width: 100%;font-size:20px; font-family:Brandon;color: white; font-style:italic"><i class="fa fa-minus"></i>
                                    {{ date('F', strtotime($value_pages['dates_range']['start'])) . ' ' . date('d', strtotime($value_pages['dates_range']['start'])) }}</span>
                                @else
                                    <span style="width: 100%;font-size:20px; font-family:Brandon;color: white; font-style:italic"><i class="fa fa-minus"></i>
                                    <?php echo str_replace('"',"",html_entity_decode(json_encode($value_pages['title']))); ?></span>
                                @endif
                            @endif
                        </li>
                        <li>
                            <span style="width: 100%;font-size:60px; font-family:Brandon;color: white; font-weight:bold"
                                class="text-uppercase text-bold">
                                <?php echo str_replace('"',"",html_entity_decode(json_encode($value_pages['headline']))); ?></span>
                        </li>
                        <li>
                            @if ($value_pages['role'] == "cover_page")
                                <span style="width: 100%;font-size:20px; font-family:Brandon;color: white; font-style:italic"><?php echo str_replace('"',"",html_entity_decode(json_encode($value_main['travel_dates']))); ?></span>
                            @endif
                        </li>
                    </ul>
                </div>
                <picture>
                    <img class="img_right"  src="{{ $value_pages['primary_image_version_1600'] }}"
                        alt="{{ $value_pages['primary_image_version_1600'] }}"
                        style="min-height: 100%;min-width: 100%;max-height: 100%;">
                </picture>

            </div>
        </div>
        <div id="right-{{($key_pages+1)}}" class="div_right col-lg-6 col-xs-12 col-sm-6" style="padding-left: 7.8rem;padding-right: 7.8rem">
            <div class="page_header_right_container" style="z-index:999">
                <div class="page_header_right_sub_container">
                    <div class="page_header_left_child">
                        <div class="btn_menu" style="display:flex">
                            <div class="menu_burger">
                                <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="19" cy="19" r="19" fill="#EEEEEE"></circle><path d="M10.75 19H27.25" stroke="#424242" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M10.75 13.5H27.25" stroke="#424242" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M10.75 24.5H27.25" stroke="#424242" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            </div>
                            <div class="menu_close" hidden>
                                <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="19" cy="19" r="19" fill="#EEEEEE"></circle><path d="M24.5 13.5L13.5 24.5" stroke="#424242" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M13.5 13.5L24.5 24.5" stroke="#424242" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            </div>
                        </div>
                        <span class="label_menu page_header_left_child_menu">Menu</span>
                        <span class="label_close page_header_left_child_menu" hidden>Close</span>
                        <!-- <div>
                            <div>
                                <ul style="position: absolute; top: 20px; left: 15px; color: white;list-style-type: none; background:black">
                                    <li>
                                        @if ($value_pages['subheadline'] != '')
                                        <span style="width: 100%;font-size:20px; font-family:Brandon;color: white; font-style:italic"><i
                                                class="fa fa-minus"></i>
                                            {{$value_pages['headline']}}</span><br>
                                        @endif
                                    </li>
                                    <li>
                                        @if ($value_pages['role'] == "cover_page")
                                            <span style="width: 100%;font-size:20px; font-family:Brandon;color: white; font-style:italic"><?php echo str_replace('"',"",html_entity_decode(json_encode($value_pages['headline']))); ?></span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div> -->
                    </div>
                    <div class="page_header_right_child">
                        <div></div>
                        <div>
                            <img src="https://media.safariportal.app/store/logo/804/logo/b7dbd59d111e78083745eb17cc3644a8.jpg" alt="logo" style="max-height:2.5rem">
                        </div>
                        <div style="display:flex;align-items: center;justify-content: space-between;">
                            <div style="margin-right: 2rem;cursor:pointer" title="Copy link to share">
                                <span class="copy_link">
                                    <svg width="1rem" height="2rem" viewBox="0 0 13 15" fill="currentColor"><mask id="a" maskUnits="userSpaceOnUse" x="-.682" y="-.004" width="14" height="15" fill="#000"><path fill="#fff" d="M-.682-.004h14v15h-14z"></path><path d="M9.925 9.596a2.299 2.299 0 0 0-1.779.821l-3.323-1.72c.158-.322.238-.677.235-1.036a2.596 2.596 0 0 0-.235-1.036l3.323-1.72a2.328 2.328 0 0 0 1.779.82 2.365 2.365 0 1 0 0-4.73A2.406 2.406 0 0 0 7.716 4.26L4.335 6a2.334 2.334 0 0 0-1.662-.685 2.365 2.365 0 0 0 .02 4.73 2.334 2.334 0 0 0 1.661-.683l3.382 1.74a2.488 2.488 0 0 0-.157.86 2.365 2.365 0 1 0 2.346-2.366Zm0-7.76A1.583 1.583 0 1 1 8.342 3.4a1.563 1.563 0 0 1 1.583-1.564ZM2.693 9.264a1.583 1.583 0 1 1 0-3.167 1.583 1.583 0 0 1 0 3.167Zm7.232 4.26a1.584 1.584 0 1 1 1.583-1.582 1.589 1.589 0 0 1-1.583 1.583Z"></path></mask><path d="M9.925 9.596a2.299 2.299 0 0 0-1.779.821l-3.323-1.72c.158-.322.238-.677.235-1.036a2.596 2.596 0 0 0-.235-1.036l3.323-1.72a2.328 2.328 0 0 0 1.779.82 2.365 2.365 0 1 0 0-4.73A2.406 2.406 0 0 0 7.716 4.26L4.335 6a2.334 2.334 0 0 0-1.662-.685 2.365 2.365 0 0 0 .02 4.73 2.334 2.334 0 0 0 1.661-.683l3.382 1.74a2.488 2.488 0 0 0-.157.86 2.365 2.365 0 1 0 2.346-2.366Zm0-7.76A1.583 1.583 0 1 1 8.342 3.4a1.563 1.563 0 0 1 1.583-1.564ZM2.693 9.264a1.583 1.583 0 1 1 0-3.167 1.583 1.583 0 0 1 0 3.167Zm7.232 4.26a1.584 1.584 0 1 1 1.583-1.582 1.589 1.589 0 0 1-1.583 1.583Z" fill="#3E3E40"></path><path d="M9.925 9.596a2.299 2.299 0 0 0-1.779.821l-3.323-1.72c.158-.322.238-.677.235-1.036a2.596 2.596 0 0 0-.235-1.036l3.323-1.72a2.328 2.328 0 0 0 1.779.82 2.365 2.365 0 1 0 0-4.73A2.406 2.406 0 0 0 7.716 4.26L4.335 6a2.334 2.334 0 0 0-1.662-.685 2.365 2.365 0 0 0 .02 4.73 2.334 2.334 0 0 0 1.661-.683l3.382 1.74a2.488 2.488 0 0 0-.157.86 2.365 2.365 0 1 0 2.346-2.366Zm0-7.76A1.583 1.583 0 1 1 8.342 3.4a1.563 1.563 0 0 1 1.583-1.564ZM2.693 9.264a1.583 1.583 0 1 1 0-3.167 1.583 1.583 0 0 1 0 3.167Zm7.232 4.26a1.584 1.584 0 1 1 1.583-1.582 1.589 1.589 0 0 1-1.583 1.583Z" stroke="#3E3E40" stroke-width=".333" mask="url(#a)"></path></svg>
                                </span>
                            </div>
                            <div style="margin-right: 2rem;cursor:pointer">
                                <span>
                                    <svg width="1rem" height="2rem" viewBox="0 0 11 15" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M5.4739 3.44519C5.40419 3.44698 5.33783 3.47547 5.28853 3.52478C5.23922 3.57408 5.21073 3.64044 5.20894 3.71015V6.60707L4.43172 5.82985C4.38253 5.78066 4.31581 5.75302 4.24625 5.75302C4.17668 5.75302 4.10996 5.78066 4.06077 5.82985C4.01158 5.87904 3.98395 5.94575 3.98395 6.01532C3.98395 6.08489 4.01158 6.1516 4.06077 6.20079L5.29726 7.43728C5.35168 7.48301 5.42049 7.50807 5.49157 7.50807C5.56265 7.50807 5.63145 7.48301 5.68587 7.43728L6.92236 6.20079C6.97155 6.1516 6.99919 6.08489 6.99919 6.01532C6.99919 5.94575 6.97155 5.87904 6.92236 5.82985C6.87317 5.78066 6.80645 5.75302 6.73689 5.75302C6.66732 5.75302 6.6006 5.78066 6.55141 5.82985L5.77419 6.60707V3.72782C5.76273 3.65401 5.72697 3.58614 5.67257 3.53494C5.61818 3.48375 5.54827 3.45217 5.4739 3.44519Z" fill="#3E3E40"></path><path d="M10.1031 3.92731L10.1031 3.92724L10.0997 3.92733C10.0086 3.92966 9.92194 3.96688 9.85753 4.03129C9.79312 4.0957 9.75591 4.18238 9.75357 4.27344L9.75354 4.27344V4.27558V13.2134C9.75268 13.3363 9.70347 13.454 9.61654 13.5409C9.52961 13.6278 9.41195 13.677 9.28902 13.6779H1.62329C1.50036 13.677 1.38271 13.6278 1.29578 13.5409C1.20884 13.454 1.15963 13.3363 1.15877 13.2134V1.41426C1.15963 1.29133 1.20884 1.17366 1.29578 1.08673C1.38271 0.999788 1.50038 0.950573 1.62332 0.949719H7.12159L7.12159 2.50917L7.12159 2.50991C7.12409 2.7887 7.23595 3.05536 7.43309 3.25251C7.63023 3.44965 7.8969 3.56151 8.17569 3.56401H8.17643L10.0842 3.56402L10.0852 3.564C10.1528 3.56314 10.2188 3.54331 10.2757 3.50675C10.3325 3.4702 10.378 3.4184 10.4068 3.35727L10.4073 3.35749L10.4103 3.3486C10.432 3.28484 10.4373 3.21662 10.4256 3.15028C10.4139 3.08395 10.3856 3.02165 10.3434 2.96918L10.3437 2.96887L10.3374 2.96251L7.72397 0.349107C7.6854 0.308309 7.63692 0.278182 7.58325 0.261667C7.53227 0.245981 7.47826 0.243085 7.42599 0.253164L1.64071 0.253163L1.64031 0.253165C1.32832 0.254664 1.02954 0.379265 0.808928 0.599876C0.588317 0.820487 0.463716 1.11927 0.462217 1.43126H0.462216V1.43166L0.462215 13.2313L0.462217 13.2317C0.463716 13.5437 0.588317 13.8425 0.808928 14.0631C1.02954 14.2837 1.32832 14.4083 1.64031 14.4098H1.64071L9.28927 14.4098L9.28967 14.4098C9.60166 14.4083 9.90044 14.2837 10.1211 14.0631C10.3417 13.8425 10.4663 13.5437 10.4678 13.2317V13.2313V4.27558H10.468L10.4675 4.26894C10.4601 4.17687 10.4187 4.09085 10.3513 4.02767C10.284 3.9645 10.1954 3.92872 10.1031 3.92731ZM8.17643 2.84979L8.17576 2.84979C8.12869 2.85017 8.08202 2.84118 8.03845 2.82335C7.99489 2.80551 7.95532 2.77918 7.92204 2.7459C7.88875 2.71262 7.86242 2.67304 7.84459 2.62948C7.82675 2.58592 7.81776 2.53925 7.81815 2.49218V2.4915V1.42083L9.24711 2.84979L8.17643 2.84979Z" fill="#3E3E40" stroke="#3E3E40" stroke-width="0.166632"></path><path d="M3.3012 10.2458C3.27078 10.2448 3.24048 10.2501 3.21218 10.2613C3.18387 10.2725 3.15817 10.2894 3.13664 10.3109C3.11512 10.3324 3.09824 10.3581 3.08705 10.3864C3.07586 10.4147 3.07059 10.445 3.07157 10.4755V12.1006C3.06886 12.1322 3.0728 12.1641 3.08314 12.1942C3.09349 12.2242 3.11 12.2518 3.13163 12.2751C3.15325 12.2983 3.17951 12.3169 3.20872 12.3294C3.23792 12.3419 3.26942 12.3482 3.3012 12.3479C3.33339 12.3497 3.36558 12.3444 3.39548 12.3324C3.42538 12.3203 3.45225 12.3018 3.47419 12.2782C3.49612 12.2546 3.51257 12.2264 3.52236 12.1957C3.53216 12.165 3.53505 12.1325 3.53084 12.1006V11.659H3.88412C3.97873 11.6661 4.07377 11.6527 4.16273 11.6197C4.25169 11.5867 4.33248 11.5349 4.39957 11.4678C4.46666 11.4008 4.51847 11.32 4.55146 11.231C4.58444 11.142 4.59782 11.047 4.59069 10.9524C4.59461 10.857 4.57842 10.7619 4.54318 10.6732C4.50793 10.5846 4.45441 10.5043 4.3861 10.4376C4.31779 10.371 4.23622 10.3195 4.14669 10.2864C4.05716 10.2534 3.96168 10.2395 3.86646 10.2458H3.3012ZM4.09609 10.9524C4.09531 10.9923 4.08627 11.0317 4.06955 11.068C4.05282 11.1043 4.02878 11.1367 3.99891 11.1632C3.96905 11.1898 3.93403 11.2099 3.89603 11.2222C3.85804 11.2346 3.8179 11.2389 3.77814 11.235H3.53084V10.6698H3.77814C3.81821 10.6641 3.85903 10.6673 3.89777 10.679C3.93651 10.6907 3.97224 10.7106 4.00249 10.7375C4.03273 10.7644 4.05677 10.7976 4.07293 10.8347C4.0891 10.8718 4.097 10.9119 4.09609 10.9524Z" fill="#3E3E40"></path><path d="M5.06755 10.2458C5.03713 10.2449 5.00683 10.2501 4.97853 10.2613C4.95022 10.2725 4.92452 10.2894 4.90299 10.3109C4.88147 10.3324 4.86459 10.3581 4.8534 10.3865C4.84221 10.4148 4.83694 10.4451 4.83792 10.4755V12.0829C4.83553 12.1137 4.83984 12.1446 4.85053 12.1735C4.86123 12.2025 4.87806 12.2288 4.89988 12.2506C4.9217 12.2724 4.94799 12.2892 4.97693 12.2999C5.00587 12.3106 5.03679 12.3149 5.06755 12.3125H5.63281C6.14507 12.3125 6.60433 11.9416 6.60433 11.2527C6.60433 10.7228 6.25105 10.2282 5.63281 10.2282H5.06755V10.2458ZM6.10974 11.288C6.10974 11.659 5.9331 11.9063 5.56215 11.9063H5.31485V10.6874H5.57981C5.9331 10.6874 6.10974 10.9347 6.10974 11.288Z" fill="#3E3E40"></path><path d="M7.84086 10.6875C7.89708 10.6875 7.951 10.6651 7.99075 10.6254C8.0305 10.5856 8.05283 10.5317 8.05283 10.4755C8.05283 10.4193 8.0305 10.3654 7.99075 10.3256C7.951 10.2858 7.89708 10.2635 7.84086 10.2635H7.11663C7.08621 10.2625 7.05591 10.2678 7.02761 10.279C6.9993 10.2902 6.9736 10.3071 6.95207 10.3286C6.93055 10.3501 6.91367 10.3758 6.90248 10.4041C6.89129 10.4324 6.88602 10.4627 6.887 10.4931V12.1182C6.88429 12.1499 6.88823 12.1818 6.89857 12.2118C6.90892 12.2419 6.92543 12.2695 6.94706 12.2927C6.96868 12.316 6.99494 12.3345 7.02415 12.3471C7.05335 12.3596 7.08485 12.3659 7.11663 12.3655C7.14882 12.3674 7.18101 12.3621 7.21091 12.3501C7.24081 12.338 7.26769 12.3195 7.28962 12.2959C7.31155 12.2723 7.328 12.2441 7.33779 12.2134C7.34759 12.1827 7.35048 12.1502 7.34627 12.1182V11.5177H7.77021C7.79961 11.5207 7.82931 11.5174 7.85735 11.5081C7.88539 11.4987 7.91112 11.4835 7.93283 11.4635C7.95455 11.4434 7.97176 11.419 7.98331 11.3918C7.99486 11.3646 8.0005 11.3352 7.99984 11.3057C7.99984 11.1644 7.91152 11.0937 7.77021 11.0937H7.34627V10.7228H7.84086V10.6875Z" fill="#3E3E40"></path><path d="M7.36392 8.58543C7.36213 8.51572 7.33364 8.44936 7.28434 8.40005C7.23503 8.35074 7.16867 8.32225 7.09896 8.32047H3.84876C3.77849 8.32047 3.7111 8.34838 3.66141 8.39807C3.61172 8.44776 3.5838 8.51515 3.5838 8.58543C3.5838 8.6557 3.61172 8.72309 3.66141 8.77278C3.7111 8.82247 3.77849 8.85039 3.84876 8.85039H7.09896C7.13395 8.85111 7.16873 8.84475 7.2012 8.83169C7.23368 8.81863 7.26318 8.79914 7.28792 8.77439C7.31267 8.74964 7.33216 8.72014 7.34522 8.68767C7.35828 8.6552 7.36464 8.62042 7.36392 8.58543Z" fill="#3E3E40"></path></svg>
                                </span>
                            </div>
                            <div>
                                <span style="cursor:pointer">
                                <svg width="1rem" height="2rem" viewBox="0 0 11 11" fill="currentColor"><path d="M8.98583 6.44274C8.64115 6.10256 8.21375 6.10256 7.87367 6.44274C7.61171 6.70017 7.35435 6.9576 7.09699 7.21963C7.02806 7.29318 6.96831 7.30697 6.88099 7.261C6.71095 7.16906 6.53172 7.09551 6.37087 6.99437C5.61717 6.52089 4.98297 5.90949 4.42689 5.22454C4.15114 4.88436 3.90298 4.51661 3.72834 4.10748C3.69617 4.02013 3.70076 3.96497 3.7697 3.90061C4.03166 3.64778 4.28442 3.39035 4.54178 3.13292C4.90024 2.77435 4.90024 2.35603 4.54178 1.99287C4.33497 1.786 4.13276 1.58374 3.92595 1.38147C3.71915 1.17001 3.50774 0.958548 3.29634 0.751684C2.95166 0.416105 2.52426 0.416105 2.18418 0.751684C1.92223 1.00911 1.66946 1.27574 1.40291 1.52857C1.15474 1.76302 1.03066 2.04803 1.00768 2.38361C0.966319 2.92605 1.09959 3.44091 1.28802 3.94198C1.67406 4.9809 2.25771 5.90029 2.97005 6.74154C3.93055 7.88159 5.07488 8.78719 6.41683 9.43996C7.01886 9.73417 7.64388 9.95942 8.32404 9.9962C8.79281 10.0238 9.19723 9.90426 9.52352 9.5411C9.74871 9.29286 9.99688 9.06301 10.2359 8.82397C10.5851 8.47 10.5897 8.04248 10.2405 7.69311C9.82224 7.27479 9.40403 6.85647 8.98583 6.44274Z" stroke="#3E3E40" stroke-width="0.75" stroke-miterlimit="10" stroke-linecap="round"></path></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Title Top page of left content -->
            <div style="margin-top:100px;margin-bottom:7.8rem;">
                @if ($value_pages['role'] != "cover_page")
                    <div style="border-bottom: 1px solid #dfdfdf;font-weight:bold;font-size:26px;font-family:Brandon; text-align:{{$value_pages['title_position']}}">
                        <span>{{ $value_pages['title'] }}</span></span>
                    </div>

                    @if ($value_pages['headline'] == "Trip Costs" || $value_pages['headline'] == "Costs")
                        <div style="font-size:15px; font-family:Hoefler">
                            <p>
                                <strong>
                                    Total <span>{{ 'per'. str_replace('"',"",json_encode($costs_details['type'],true)) }} </span>
                                    based on <span>{{ str_replace('"',"",json_encode($costs_details['guest_count'],true)) }} </span>
                                    guests in shared accommodation: <span>{{ str_replace('"',"",json_encode($costs_details['value'],true)).' '.strtoupper(str_replace('"',"",json_encode($costs_details['currency'],true))) }} </span>
                                </strong>
                            </p>
                            @if ($costs_details['notes_enabled'])
                                <p>
                                    <strong>
                                        Notes:
                                    </strong>
                                </p>
                                <p>
                                    {{ str_replace('"',"",json_encode($costs_details['notes_wysiwyg']['data']['text'],true)) }}
                                </p>
                            @endif
                            <p>
                                <strong>
                                    This cost includes:
                                </strong>
                            </p>
                            <p>
                                {{ str_replace('"',"",json_encode($costs_details['includes_wysiwyg']['data']['text'],true)) }}
                            </p>
                            <p>
                                <strong>
                                    This cost does not include:
                                </strong>
                            </p>
                            <p>
                                {{ str_replace('"',"",json_encode($costs_details['not_includes_wysiwyg']['data']['text'],true)) }}
                            </p>
                        </div>
                    @endif
                @endif
                @foreach ($value_pages['blocks'] as $key_blocks => $value_blocks)
                    @foreach ($value_blocks['data'] as $key_data => $value_data)
                        @if (is_array($value_data))
                            <!-- array code -->
                                @if($key_data == "files")
                                    <div class="row">
                                        @foreach ($value_data as $key_files => $value_files )
                                            @if(sizeof($value_data) < 3)
                                                    @if (sizeof($value_data) == 1)
                                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                                            <img src="{{$value_files['url']}}" alt="logo" style="width:100%">
                                                        </div>
                                                        <!-- <div class="col-lg-12 col-sm-12 col-xs-12">
                                                            <img src="{{$value_pages['primary_image_version_800']}}" alt="logo" style="width:100%">
                                                        </div> -->
                                                    @else 
                                                        <!-- 2 -->
                                                        <div class="col-lg-6 col-sm-12 col-xs-12">
                                                            <img src="{{$value_files['url']}}" alt="logo" style="width:100%; height: 350px;">
                                                        </div>
                                                    @endif
                                            @else
                                                <div class="col-lg-4 col-sm-12 col-xs-12">
                                                    <img src="{{$value_files['url']}}" alt="logo" style="width:100%; height: 150px;">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <br>
                                @endif

                                <!-- Fast Facts -->
                                @if ($key_data == "items")
                                    @foreach ($value_data as $key_files => $value_files )
                                        <div style="width: 100%;font-size:15px; font-family:Georgia;font-weight:bold">
                                            <span>{{ str_replace('"',"",html_entity_decode(json_encode($value_files['title']))) }}</span>
                                        </div><br>
                                        
                                        @foreach ($value_files['desc']['raw'] as $key_text => $value_text)
                                            @if (!empty($value_text))
                                                @foreach ($value_text as $key_text_data => $value_text_data)
                                                    <p data-text="true" style="font-size:15px; font-family:Hoefler,Georgia;">{{ str_replace("\u2019","'",str_replace('"',"",html_entity_decode(json_encode($value_text_data['text'])))) }}</p>
                                                @endforeach
                                            @endif
                                        @endforeach
                                      
                                    @endforeach
                                @endif
                            <!-- @if ($key_data == "items")
                                <span style="width: 100%;font-size:15px; font-family:Hoefler,Georgia; font-weight:bold" ><?php echo str_replace('"',"",html_entity_decode(json_encode($value_pages))); ?></span>
                            @endif -->
                        @else
                            @if (filter_var($value_data, FILTER_VALIDATE_URL))
                                @if(strpos($value_data, "watch?v=") !== false)
                                    <iframe width="100%" height="420" src="{{str_replace('watch?v=','embed/',$value_data)}}" frameborder="0"
                                    allowfullscreen></iframe>
                                @else
                                    <iframe width="100%" height="420" src="{{str_replace('https://youtu.be/','https://www.youtube.com/embed/',$value_data)}}" frameborder="0"
                                allowfullscreen></iframe>
                                @endif
                            @else
                                @if ($value_pages['role'] == "cover_page")
                                    <div>
                                        <div style="position:relative;">
                                            <div style="text-align:center; margin-top:50px">
                                                <span data-text="true"
                                                    {{ $key_data == 'title' ? 'style=width:100%;font-weight:bold;font-size:25px;font-family:Georgia;' : 'style=width:100%;font-style:italic;font-size:13px;font-family:Georgia;' }}
                                                    {{ $key_data == 'title' ? 'class=text-uppercase text-lg-center' : '' }}>{{$value_data}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <!-- @if ($key_data == "title")
                                        <span> {{$value_data}}</span>
                                    @endif -->
                                    @if ($key_data == "subtitle")
                                        <span data-text="true" style="width: 100%;font-style: italic;font-size:13px; font-family:Georgia;">{{$value_data}}</span>
                                    @endif
                                    @if ($key_data == "subheadline")
                                        <div style="width: 100%;font-style: italic;font-size:20px; font-family:Georgia; text-align:{{$value_pages['title_position']}}">
                                            <span>{{ str_replace("1","",$value_data) }}</span>
                                        </div><br>
                                        <div style="text-align:center" class="pr-5 pl-5">
                                            <!-- Trip Overview  Detailed Itinerary dates-->
                                            @if (($value_pages['title'] == "Trip Overview" || $value_pages['title'] == "Safari Overview" || $value_pages['title'] == "Overview") && $value_data == "Detailed Itinerary" || $value_data == "Itinerary at a glance")
                                                @foreach (json_decode($value_main['schedules'],true) as $key_schedules => $value_schedules)
                                                    <div style="margin: 0 auto 3rem;max-width: 500px;">
                                                        @if (!is_null($value_schedules['dates_range']['start']) && !is_null($value_schedules['dates_range']['end']))
                                                            @if (date('F', strtotime($value_schedules['dates_range']['start'])) == date('F', strtotime($value_schedules['dates_range']['end'])))
                                                            <p style="width: 100%;font-size:15px; font-family:Hoefler,Georgia; font-weight:bold" >
                                                                {{ date('F', strtotime($value_schedules['dates_range']['start'])) . ' ' . date('d', strtotime($value_schedules['dates_range']['start'])) }}
                                                                -
                                                                {{ date('d', strtotime($value_schedules['dates_range']['end'])) }}</p>
                                                            @else
                                                            <p style="width: 100%;font-size:15px; font-family:Hoefler,Georgia; font-weight:bold" >
                                                                {{ date('F', strtotime($value_schedules['dates_range']['start'])) . ' ' . date('d', strtotime($value_schedules['dates_range']['start'])) }}
                                                                -
                                                                {{ date('F', strtotime($value_schedules['dates_range']['end'])) . ' ' . date('d', strtotime($value_schedules['dates_range']['end'])) }}</p>
                                                            @endif
                                                        @elseif (!is_null($value_schedules['dates_range']['start']) && is_null($value_schedules['dates_range']['end']))
                                                            <p style="width: 100%;font-size:15px; font-family:Hoefler,Georgia; font-weight:bold" >
                                                            {{ date('F', strtotime($value_schedules['dates_range']['start'])) . ' ' . date('d', strtotime($value_schedules['dates_range']['start'])) }}</p>
                                                        @else
                                                            <p style="width: 100%;font-size:15px; font-family:Hoefler,Georgia; font-weight:bold" ><?php echo str_replace('"',"",html_entity_decode(json_encode($value_pages['title']))); ?></p>
                                                        @endif
                                                        @foreach ($value_schedules['details'] as $key_schedules_details => $value_schedules_details)
                                                            @if (!empty($value_schedules_details['blocks']))
                                                                @foreach ($value_schedules_details['blocks'] as $key_schedules_details_blocks => $value_schedules_details_blocks)
                                                                    <p style="font-size:15px; font-family:Hoefler,Georgia;white-space: break-spaces;">{{$value_schedules_details_blocks['text']}}</p>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                        @foreach ($value_schedules['accommodation'] as $key_schedules_details => $value_schedules_details)
                                                            @if (!empty($value_schedules_details['blocks']))
                                                                @foreach ($value_schedules_details['blocks'] as $key_schedules_details_blocks => $value_schedules_details_blocks)
                                                                    <p style="font-size:15px; font-family:Hoefler,Georgia;white-space: break-spaces;">{{$value_schedules_details_blocks['text']}}</p>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            @endif

                                            <!-- Trip Overview Visualize your journey dates-->
                                            @if (($value_pages['title'] == "Trip Overview" || $value_pages['title'] == "Safari Overview" || $value_pages['title'] == "Overview") && $value_data == "Visualize your journey")
                                                <div id="gmap" style="width:100%;height:350px;z-index:9999"></div>
                                                <br>
                                                <span style="width: 100%;font-size:13px; font-family:Hoefler,Georgia; font-weight:bold">Key Dates</span><br>
                                                @foreach (json_decode($value_main['way'],true) as $key_way => $value_way)
                                                    <span style="width: 100%;font-size:15px; font-family:Hoefler,Georgia; font-weight:bold">{{ ($key_way+1)}} )</span>
                                                    <!-- {{ preg_replace('/[^0-9,. -]/', '',html_entity_decode(json_encode($value_way['time_range']))) }} -->
                                                    @if (count(collect($value_way['time_range'])->toArray()) > 1)
                                                        @if (date('F',strtotime(collect($value_way['time_range'])->toArray()[0])) == date('F',strtotime(collect($value_way['time_range'])->toArray()[1])))
                                                            {{ date('F',strtotime(collect($value_way['time_range'])->toArray()[0])).' '.date('d',strtotime(collect($value_way['time_range'])->toArray()[0])).'-'.date('d',strtotime(collect($value_way['time_range'])->toArray()[1])).': '}}
                                                        @else
                                                            {{ date('F',strtotime(collect($value_way['time_range'])->toArray()[0])).' '.date('d',strtotime(collect($value_way['time_range'])->toArray()[0])).'-'.date('F',strtotime(collect($value_way['time_range'])->toArray()[1])).' '.date('d',strtotime(collect($value_way['time_range'])->toArray()[1])) .': '}}
                                                        @endif
                                                        
                                                    @else
                                                        {{ date('F',strtotime(collect($value_way['time_range'])->toArray()[0])) .' '.date('d',strtotime(collect($value_way['time_range'])->toArray()[0])) .': ' }}
                                                    @endif
                                                
                                                    <!-- <span style="width: 100%;font-size:15px; font-family:Hoefler,Georgia;">
                                                    <?php echo date('F',strtotime(str_replace(']',"",str_replace('[',"",str_replace('"',"",html_entity_decode(json_encode($value_way['time_range']))))))).' '.date('d',strtotime(str_replace(']',"",str_replace('[',"",str_replace('"',"",html_entity_decode(json_encode($value_way['time_range']))))))); ?> : </span> -->
                                                    <?php echo str_replace('"',"",html_entity_decode(json_encode($value_way['property_name']))).', '.str_replace('"',"",html_entity_decode(json_encode($value_way['area_name']))) ?></span><br>
                                                        <input hidden type="text" id="latitude-{{$key_way}}" class="latitude" value='{{ str_replace('"',"",html_entity_decode(json_encode($value_way['latitude']))) }}' />
                                                        <input hidden type="text" id="longitude-{{$key_way}}" class="latitude" value='{{ str_replace('"',"",html_entity_decode(json_encode($value_way['longitude']))) }}' />
                                                        <input hidden id="input_add-{{$key_way}}" class="input_add" type="text" value='"{{ str_replace('"',"",html_entity_decode(json_encode($value_way['property_name']))).', '.str_replace('"',"",html_entity_decode(json_encode($value_way['area_name']))) }}"' />
                                                @endforeach
                                            @endif
                                        </div>
                                    @endif

                                    @if ($key_data == "text")
                                        @if(str_contains(html_entity_decode(json_encode($value_data)),'\t'))
                                            <span data-text="true" style="font-size:15px; font-family:Hoefler,Georgia;white-space: break-spaces;">{{$value_data}}</span>
                                        @else
                                            <span data-text="true" style="width: 100%;font-size:15px; font-family:Hoefler,Georgia;">{{$value_data}}</span><br>
                                        @endif
                                        <br>
                                    @endif
                                @endif
                            @endif
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
        @endforeach
    @endforeach
</div>
@endsection
@push('scripts')
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKE1K0kktobY7DWjF8sZk6r0Mffcm0JOg&region=Asia&callback=initAutocomplete&libraries=places&v=weekly"
    async></script>
<script>
let geocoder;
let map;
function initAutocomplete() {
        var center = {lat: Number($('#latitude-0').val()), lng: Number($('#longitude-0').val())};
        
        // var locations = [
        //     ['Jetwing Beach', 7.243739, 79.841629],
        //     ['Cinnamon Wild', 6.259211, 81.404372],
        //     ['98 Acres', 6.871147, 81.062417],
        //     ['Aliya Resort & Spa Sigiriya', 7.999085, 80.73625],
        //     ['Uga Jungle Beach Resort', 8.771167, 81.13623, ]
        // ];
        // for(var i = 0; i <= $('.input_add').length; i++){
        //     if($('.input_add')[i] !== undefined){
        //         console.log($('#input_add-'+[i]).val() + ", "+ $('#latitude-'+[i]).val() + ", " + $('#longitude-'+[i]).val());
        //     }
        // }
           
            var map = new google.maps.Map(document.getElementById('gmap'), {
                zoom: 6.5,
                center: center
            });
            var infowindow =  new google.maps.InfoWindow({});
            var marker, count;
            for(var i = 0; i <= $('.input_add').length; i++){
                marker = new google.maps.Marker({
                        position: new google.maps.LatLng($('#latitude-'+[i]).val(), $('#longitude-'+[i]).val()),
                        map: map,
                        title: $('#input_add-'+[i]).val()
                        });
                    google.maps.event.addListener(marker, 'click', (function (marker, i) {
                        return function () {
                            infowindow.setContent($('#input_add-'+[i]).val().replace('"',""));
                            infowindow.open(map, marker);
                        }
                        })(marker, i));
            }
            // for (count = 0; count < locations.length; count++) {
            //     marker = new google.maps.Marker({
            //     position: new google.maps.LatLng(locations[count][1], locations[count][2]),
            //     map: map,
            //     title: locations[count][0]
            //     });
            // google.maps.event.addListener(marker, 'click', (function (marker, count) {
            //     return function () {
            //         infowindow.setContent(locations[count][0]);
            //         infowindow.open(map, marker);
            //     }
            //     })(marker, count));
            // }
        }
$(document).ready(function() {
    $('#loader-container').html(PRELOADING);
    //remove element for fullscreen
    $('div.wrapper').removeClass('wrapper');
    $('div.sidebar').remove();
    $('nav.navbar').remove();
    $('div.main-panel').removeClass('main-panel ps-container ps-theme-default ps-active-x ps-active-y');
    $('div.content').removeClass('content');
    $('footer.footer').remove();
    setTimeout(() => {
        $('#div_main_row').removeAttr('hidden');

        $('#loader-container').html('');
        $('#loader-container').attr('hidden', true);
        $('#content-container').html('');
        $('#content-container').attr('hidden', true);
        var noOfDiv = $('.div_right').length;
        for (var i = 1; i <= noOfDiv; i++){
            if($('#right-'+i).height() > ($(window).height()+20)){
                    $('#right-'+i).css({"height": ($(window).height()+20)+'px', "overflow-y": "scroll"});
            }
        }
    }, 1300);
    initAutocomplete();
    $('.img_right').css('height', ($(window).height()+20)+'px');
    $('.btn_menu').click(function (param) { 
        if($('#id_table_contents').hasClass('table_contents_hide')){
            $('#id_table_contents').removeClass('table_contents_hide').addClass('table_contents_show');
            //
            $('.menu_burger').attr('hidden',true);
            $('.menu_close').removeAttr('hidden');
            //
            $('.label_menu').attr('hidden',true);
            $('.label_close').removeAttr('hidden');
        }else{
            $('#id_table_contents').removeClass('table_contents_show').addClass('table_contents_hide');
            //
            $('.menu_close').attr('hidden',true);
            $('.menu_burger').removeAttr('hidden');
            //
            $('.label_close').attr('hidden',true);
            $('.label_menu').removeAttr('hidden');
        }
     });
     
     $('.copy_link').click(function (e) { 
        e.preventDefault();
        navigator.clipboard.writeText(window.location.href);
        alert("The link has been copied to your clipboard.");
        //The link has been copied to your clipboard.
     });
    // $('.footer').css('padding', '0');
});
</script>
@endpush