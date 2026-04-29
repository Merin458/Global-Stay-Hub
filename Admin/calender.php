<?php
include('header.php');
?>
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-calendar bg-blue"></i>
                    <div class="d-inline">
                        <h5>Calendar</h5>
                        <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../index.html"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Apps</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Calendar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="calendar" class="fc fc-unthemed fc-ltr">
                        <div class="fc-toolbar fc-header-toolbar">
                            <div class="fc-left">
                                <div class="fc-button-group"><button type="button"
                                        class="fc-prev-button fc-button fc-state-default fc-corner-left"
                                        aria-label="prev"><span
                                            class="fc-icon fc-icon-left-single-arrow"></span></button><button
                                        type="button" class="fc-next-button fc-button fc-state-default fc-corner-right"
                                        aria-label="next"><span
                                            class="fc-icon fc-icon-right-single-arrow"></span></button></div><button
                                    type="button"
                                    class="fc-today-button fc-button fc-state-default fc-corner-left fc-corner-right fc-state-disabled"
                                    disabled="">today</button>
                            </div>
                            <div class="fc-right">
                                <div class="fc-button-group"><button type="button"
                                        class="fc-month-button fc-button fc-state-default fc-corner-left fc-state-active">month</button><button
                                        type="button"
                                        class="fc-agendaWeek-button fc-button fc-state-default">week</button><button
                                        type="button"
                                        class="fc-agendaDay-button fc-button fc-state-default fc-corner-right">day</button>
                                </div>
                            </div>
                            <div class="fc-center">
                                <h2>October 2025</h2>
                            </div>
                            <div class="fc-clear"></div>
                        </div>
                        <div class="fc-view-container" style="">
                            <div class="fc-view fc-month-view fc-basic-view" style="">
                                <table class="">
                                    <thead class="fc-head">
                                        <tr>
                                            <td class="fc-head-container fc-widget-header">
                                                <div class="fc-row fc-widget-header">
                                                    <table class="">
                                                        <thead>
                                                            <tr>
                                                                <th class="fc-day-header fc-widget-header fc-sun">
                                                                    <span>Sun</span></th>
                                                                <th class="fc-day-header fc-widget-header fc-mon">
                                                                    <span>Mon</span></th>
                                                                <th class="fc-day-header fc-widget-header fc-tue">
                                                                    <span>Tue</span></th>
                                                                <th class="fc-day-header fc-widget-header fc-wed">
                                                                    <span>Wed</span></th>
                                                                <th class="fc-day-header fc-widget-header fc-thu">
                                                                    <span>Thu</span></th>
                                                                <th class="fc-day-header fc-widget-header fc-fri">
                                                                    <span>Fri</span></th>
                                                                <th class="fc-day-header fc-widget-header fc-sat">
                                                                    <span>Sat</span></th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody class="fc-body">
                                        <tr>
                                            <td class="fc-widget-content">
                                                <div class="fc-scroller fc-day-grid-container"
                                                    style="overflow: hidden; height: 807.4px;">
                                                    <div class="fc-day-grid fc-unselectable">
                                                        <div class="fc-row fc-week fc-widget-content"
                                                            style="height: 134px;">
                                                            <div class="fc-bg">
                                                                <table class="">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="fc-day fc-widget-content fc-sun fc-other-month fc-past"
                                                                                data-date="2025-09-28"></td>
                                                                            <td class="fc-day fc-widget-content fc-mon fc-other-month fc-past"
                                                                                data-date="2025-09-29"></td>
                                                                            <td class="fc-day fc-widget-content fc-tue fc-other-month fc-past"
                                                                                data-date="2025-09-30"></td>
                                                                            <td class="fc-day fc-widget-content fc-wed fc-past"
                                                                                data-date="2025-10-01"></td>
                                                                            <td class="fc-day fc-widget-content fc-thu fc-past"
                                                                                data-date="2025-10-02"></td>
                                                                            <td class="fc-day fc-widget-content fc-fri fc-past"
                                                                                data-date="2025-10-03"></td>
                                                                            <td class="fc-day fc-widget-content fc-sat fc-past"
                                                                                data-date="2025-10-04"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="fc-content-skeleton">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <td class="fc-day-top fc-sun fc-other-month fc-past"
                                                                                data-date="2025-09-28"><span
                                                                                    class="fc-day-number">28</span></td>
                                                                            <td class="fc-day-top fc-mon fc-other-month fc-past"
                                                                                data-date="2025-09-29"><span
                                                                                    class="fc-day-number">29</span></td>
                                                                            <td class="fc-day-top fc-tue fc-other-month fc-past"
                                                                                data-date="2025-09-30"><span
                                                                                    class="fc-day-number">30</span></td>
                                                                            <td class="fc-day-top fc-wed fc-past"
                                                                                data-date="2025-10-01"><span
                                                                                    class="fc-day-number">1</span></td>
                                                                            <td class="fc-day-top fc-thu fc-past"
                                                                                data-date="2025-10-02"><span
                                                                                    class="fc-day-number">2</span></td>
                                                                            <td class="fc-day-top fc-fri fc-past"
                                                                                data-date="2025-10-03"><span
                                                                                    class="fc-day-number">3</span></td>
                                                                            <td class="fc-day-top fc-sat fc-past"
                                                                                data-date="2025-10-04"><span
                                                                                    class="fc-day-number">4</span></td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td class="fc-event-container"><a
                                                                                    class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-purple fc-draggable">
                                                                                    <div class="fc-content"><span
                                                                                            class="fc-time">12a</span>
                                                                                        <span class="fc-title">All Day
                                                                                            Event</span></div>
                                                                                </a></td>
                                                                            <td class="fc-event-container" colspan="3">
                                                                                <a
                                                                                    class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-yellow fc-draggable">
                                                                                    <div class="fc-content"><span
                                                                                            class="fc-time">12a</span>
                                                                                        <span class="fc-title">Long
                                                                                            Event</span></div>
                                                                                </a></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="fc-row fc-week fc-widget-content"
                                                            style="height: 134px;">
                                                            <div class="fc-bg">
                                                                <table class="">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="fc-day fc-widget-content fc-sun fc-past"
                                                                                data-date="2025-10-05"></td>
                                                                            <td class="fc-day fc-widget-content fc-mon fc-past"
                                                                                data-date="2025-10-06"></td>
                                                                            <td class="fc-day fc-widget-content fc-tue fc-today "
                                                                                data-date="2025-10-07"></td>
                                                                            <td class="fc-day fc-widget-content fc-wed fc-future"
                                                                                data-date="2025-10-08"></td>
                                                                            <td class="fc-day fc-widget-content fc-thu fc-future"
                                                                                data-date="2025-10-09"></td>
                                                                            <td class="fc-day fc-widget-content fc-fri fc-future"
                                                                                data-date="2025-10-10"></td>
                                                                            <td class="fc-day fc-widget-content fc-sat fc-future"
                                                                                data-date="2025-10-11"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="fc-content-skeleton">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <td class="fc-day-top fc-sun fc-past"
                                                                                data-date="2025-10-05"><span
                                                                                    class="fc-day-number">5</span></td>
                                                                            <td class="fc-day-top fc-mon fc-past"
                                                                                data-date="2025-10-06"><span
                                                                                    class="fc-day-number">6</span></td>
                                                                            <td class="fc-day-top fc-tue fc-today "
                                                                                data-date="2025-10-07"><span
                                                                                    class="fc-day-number">7</span></td>
                                                                            <td class="fc-day-top fc-wed fc-future"
                                                                                data-date="2025-10-08"><span
                                                                                    class="fc-day-number">8</span></td>
                                                                            <td class="fc-day-top fc-thu fc-future"
                                                                                data-date="2025-10-09"><span
                                                                                    class="fc-day-number">9</span></td>
                                                                            <td class="fc-day-top fc-fri fc-future"
                                                                                data-date="2025-10-10"><span
                                                                                    class="fc-day-number">10</span></td>
                                                                            <td class="fc-day-top fc-sat fc-future"
                                                                                data-date="2025-10-11"><span
                                                                                    class="fc-day-number">11</span></td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td rowspan="2"></td>
                                                                            <td rowspan="2"></td>
                                                                            <td class="fc-event-container"><a
                                                                                    class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-red fc-draggable">
                                                                                    <div class="fc-content"><span
                                                                                            class="fc-time">10:30a</span>
                                                                                        <span
                                                                                            class="fc-title">Meeting</span>
                                                                                    </div>
                                                                                </a></td>
                                                                            <td class="fc-event-container" rowspan="2">
                                                                                <a
                                                                                    class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-green fc-draggable">
                                                                                    <div class="fc-content"><span
                                                                                            class="fc-time">7p</span>
                                                                                        <span class="fc-title">Birthday
                                                                                            Party</span></div>
                                                                                </a></td>
                                                                            <td rowspan="2"></td>
                                                                            <td rowspan="2"></td>
                                                                            <td rowspan="2"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-event-container"><a
                                                                                    class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-navy fc-draggable">
                                                                                    <div class="fc-content"><span
                                                                                            class="fc-time">12p</span>
                                                                                        <span
                                                                                            class="fc-title">Lunch</span>
                                                                                    </div>
                                                                                </a></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="fc-row fc-week fc-widget-content"
                                                            style="height: 134px;">
                                                            <div class="fc-bg">
                                                                <table class="">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="fc-day fc-widget-content fc-sun fc-future"
                                                                                data-date="2025-10-12"></td>
                                                                            <td class="fc-day fc-widget-content fc-mon fc-future"
                                                                                data-date="2025-10-13"></td>
                                                                            <td class="fc-day fc-widget-content fc-tue fc-future"
                                                                                data-date="2025-10-14"></td>
                                                                            <td class="fc-day fc-widget-content fc-wed fc-future"
                                                                                data-date="2025-10-15"></td>
                                                                            <td class="fc-day fc-widget-content fc-thu fc-future"
                                                                                data-date="2025-10-16"></td>
                                                                            <td class="fc-day fc-widget-content fc-fri fc-future"
                                                                                data-date="2025-10-17"></td>
                                                                            <td class="fc-day fc-widget-content fc-sat fc-future"
                                                                                data-date="2025-10-18"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="fc-content-skeleton">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <td class="fc-day-top fc-sun fc-future"
                                                                                data-date="2025-10-12"><span
                                                                                    class="fc-day-number">12</span></td>
                                                                            <td class="fc-day-top fc-mon fc-future"
                                                                                data-date="2025-10-13"><span
                                                                                    class="fc-day-number">13</span></td>
                                                                            <td class="fc-day-top fc-tue fc-future"
                                                                                data-date="2025-10-14"><span
                                                                                    class="fc-day-number">14</span></td>
                                                                            <td class="fc-day-top fc-wed fc-future"
                                                                                data-date="2025-10-15"><span
                                                                                    class="fc-day-number">15</span></td>
                                                                            <td class="fc-day-top fc-thu fc-future"
                                                                                data-date="2025-10-16"><span
                                                                                    class="fc-day-number">16</span></td>
                                                                            <td class="fc-day-top fc-fri fc-future"
                                                                                data-date="2025-10-17"><span
                                                                                    class="fc-day-number">17</span></td>
                                                                            <td class="fc-day-top fc-sat fc-future"
                                                                                data-date="2025-10-18"><span
                                                                                    class="fc-day-number">18</span></td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="fc-row fc-week fc-widget-content"
                                                            style="height: 134px;">
                                                            <div class="fc-bg">
                                                                <table class="">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="fc-day fc-widget-content fc-sun fc-future"
                                                                                data-date="2025-10-19"></td>
                                                                            <td class="fc-day fc-widget-content fc-mon fc-future"
                                                                                data-date="2025-10-20"></td>
                                                                            <td class="fc-day fc-widget-content fc-tue fc-future"
                                                                                data-date="2025-10-21"></td>
                                                                            <td class="fc-day fc-widget-content fc-wed fc-future"
                                                                                data-date="2025-10-22"></td>
                                                                            <td class="fc-day fc-widget-content fc-thu fc-future"
                                                                                data-date="2025-10-23"></td>
                                                                            <td class="fc-day fc-widget-content fc-fri fc-future"
                                                                                data-date="2025-10-24"></td>
                                                                            <td class="fc-day fc-widget-content fc-sat fc-future"
                                                                                data-date="2025-10-25"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="fc-content-skeleton">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <td class="fc-day-top fc-sun fc-future"
                                                                                data-date="2025-10-19"><span
                                                                                    class="fc-day-number">19</span></td>
                                                                            <td class="fc-day-top fc-mon fc-future"
                                                                                data-date="2025-10-20"><span
                                                                                    class="fc-day-number">20</span></td>
                                                                            <td class="fc-day-top fc-tue fc-future"
                                                                                data-date="2025-10-21"><span
                                                                                    class="fc-day-number">21</span></td>
                                                                            <td class="fc-day-top fc-wed fc-future"
                                                                                data-date="2025-10-22"><span
                                                                                    class="fc-day-number">22</span></td>
                                                                            <td class="fc-day-top fc-thu fc-future"
                                                                                data-date="2025-10-23"><span
                                                                                    class="fc-day-number">23</span></td>
                                                                            <td class="fc-day-top fc-fri fc-future"
                                                                                data-date="2025-10-24"><span
                                                                                    class="fc-day-number">24</span></td>
                                                                            <td class="fc-day-top fc-sat fc-future"
                                                                                data-date="2025-10-25"><span
                                                                                    class="fc-day-number">25</span></td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="fc-row fc-week fc-widget-content"
                                                            style="height: 134px;">
                                                            <div class="fc-bg">
                                                                <table class="">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="fc-day fc-widget-content fc-sun fc-future"
                                                                                data-date="2025-10-26"></td>
                                                                            <td class="fc-day fc-widget-content fc-mon fc-future"
                                                                                data-date="2025-10-27"></td>
                                                                            <td class="fc-day fc-widget-content fc-tue fc-future"
                                                                                data-date="2025-10-28"></td>
                                                                            <td class="fc-day fc-widget-content fc-wed fc-future"
                                                                                data-date="2025-10-29"></td>
                                                                            <td class="fc-day fc-widget-content fc-thu fc-future"
                                                                                data-date="2025-10-30"></td>
                                                                            <td class="fc-day fc-widget-content fc-fri fc-future"
                                                                                data-date="2025-10-31"></td>
                                                                            <td class="fc-day fc-widget-content fc-sat fc-other-month fc-future"
                                                                                data-date="2025-11-01"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="fc-content-skeleton">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <td class="fc-day-top fc-sun fc-future"
                                                                                data-date="2025-10-26"><span
                                                                                    class="fc-day-number">26</span></td>
                                                                            <td class="fc-day-top fc-mon fc-future"
                                                                                data-date="2025-10-27"><span
                                                                                    class="fc-day-number">27</span></td>
                                                                            <td class="fc-day-top fc-tue fc-future"
                                                                                data-date="2025-10-28"><span
                                                                                    class="fc-day-number">28</span></td>
                                                                            <td class="fc-day-top fc-wed fc-future"
                                                                                data-date="2025-10-29"><span
                                                                                    class="fc-day-number">29</span></td>
                                                                            <td class="fc-day-top fc-thu fc-future"
                                                                                data-date="2025-10-30"><span
                                                                                    class="fc-day-number">30</span></td>
                                                                            <td class="fc-day-top fc-fri fc-future"
                                                                                data-date="2025-10-31"><span
                                                                                    class="fc-day-number">31</span></td>
                                                                            <td class="fc-day-top fc-sat fc-other-month fc-future"
                                                                                data-date="2025-11-01"><span
                                                                                    class="fc-day-number">1</span></td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td class="fc-event-container"><a
                                                                                    class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-lime fc-draggable"
                                                                                    href="http://google.com/">
                                                                                    <div class="fc-content"><span
                                                                                            class="fc-time">12a</span>
                                                                                        <span class="fc-title">Click for
                                                                                            Google</span></div>
                                                                                </a></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="fc-row fc-week fc-widget-content"
                                                            style="height: 137px;">
                                                            <div class="fc-bg">
                                                                <table class="">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="fc-day fc-widget-content fc-sun fc-other-month fc-future"
                                                                                data-date="2025-11-02"></td>
                                                                            <td class="fc-day fc-widget-content fc-mon fc-other-month fc-future"
                                                                                data-date="2025-11-03"></td>
                                                                            <td class="fc-day fc-widget-content fc-tue fc-other-month fc-future"
                                                                                data-date="2025-11-04"></td>
                                                                            <td class="fc-day fc-widget-content fc-wed fc-other-month fc-future"
                                                                                data-date="2025-11-05"></td>
                                                                            <td class="fc-day fc-widget-content fc-thu fc-other-month fc-future"
                                                                                data-date="2025-11-06"></td>
                                                                            <td class="fc-day fc-widget-content fc-fri fc-other-month fc-future"
                                                                                data-date="2025-11-07"></td>
                                                                            <td class="fc-day fc-widget-content fc-sat fc-other-month fc-future"
                                                                                data-date="2025-11-08"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="fc-content-skeleton">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <td class="fc-day-top fc-sun fc-other-month fc-future"
                                                                                data-date="2025-11-02"><span
                                                                                    class="fc-day-number">2</span></td>
                                                                            <td class="fc-day-top fc-mon fc-other-month fc-future"
                                                                                data-date="2025-11-03"><span
                                                                                    class="fc-day-number">3</span></td>
                                                                            <td class="fc-day-top fc-tue fc-other-month fc-future"
                                                                                data-date="2025-11-04"><span
                                                                                    class="fc-day-number">4</span></td>
                                                                            <td class="fc-day-top fc-wed fc-other-month fc-future"
                                                                                data-date="2025-11-05"><span
                                                                                    class="fc-day-number">5</span></td>
                                                                            <td class="fc-day-top fc-thu fc-other-month fc-future"
                                                                                data-date="2025-11-06"><span
                                                                                    class="fc-day-number">6</span></td>
                                                                            <td class="fc-day-top fc-fri fc-other-month fc-future"
                                                                                data-date="2025-11-07"><span
                                                                                    class="fc-day-number">7</span></td>
                                                                            <td class="fc-day-top fc-sat fc-other-month fc-future"
                                                                                data-date="2025-11-08"><span
                                                                                    class="fc-day-number">8</span></td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="editEvent" tabindex="-1" role="dialog" aria-labelledby="editEventLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="editEventForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editEventLabel">Edit Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editEname">Event Title</label>
                            <input type="text" class="form-control" id="editEname" name="editEname"
                                placeholder="Please enter event title">
                        </div>
                        <div class="form-group">
                            <label for="editStarts">Start</label>
                            <input type="text" class="form-control datetimepicker-input" id="editStarts"
                                name="editStarts" data-toggle="datetimepicker" data-target="#editStarts">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-danger delete-event" type="submit">Delete</button>
                        <button class="btn btn-success save-event" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal" id="addEvent" tabindex="-1" role="dialog" aria-labelledby="addEventLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventLabel">Add New Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form id="addEventForm">
                        <div class="form-group">
                            <label for="eventName">Event Title</label>
                            <input type="text" class="form-control" id="eventName" name="eventName"
                                placeholder="Please enter event title">
                        </div>
                        <div class="form-group">
                            <label for="eventStarts">Starts</label>
                            <input type="text" class="form-control datetimepicker-input" id="eventStarts"
                                name="eventStarts" data-toggle="datetimepicker" data-target="#eventStarts">
                        </div>
                        <div class="form-group mb-0" id="addColor">
                            <label for="colors">Choose Color</label>
                            <ul class="color-selector">
                                <li class="bg-aqua">
                                    <input type="radio" data-color="bg-aqua" checked="" name="colorChosen"
                                        id="addColorAqua">
                                    <label for="addColorAqua"></label>
                                </li>
                                <li class="bg-blue">
                                    <input type="radio" data-color="bg-blue" name="colorChosen" id="addColorBlue">
                                    <label for="addColorBlue"></label>
                                </li>
                                <li class="bg-light-blue">
                                    <input type="radio" data-color="bg-light-blue" name="colorChosen"
                                        id="addColorLightblue">
                                    <label for="addColorLightblue"></label>
                                </li>
                                <li class="bg-teal">
                                    <input type="radio" data-color="bg-teal" name="colorChosen" id="addColorTeal">
                                    <label for="addColorTeal"></label>
                                </li>
                                <li class="bg-yellow">
                                    <input type="radio" data-color="bg-yellow" name="colorChosen" id="addColorYellow">
                                    <label for="addColorYellow"></label>
                                </li>
                                <li class="bg-orange">
                                    <input type="radio" data-color="bg-orange" name="colorChosen" id="addColorOrange">
                                    <label for="addColorOrange"></label>
                                </li>
                                <li class="bg-green">
                                    <input type="radio" data-color="bg-green" name="colorChosen" id="addColorGreen">
                                    <label for="addColorGreen"></label>
                                </li>
                                <li class="bg-lime">
                                    <input type="radio" data-color="bg-lime" name="colorChosen" id="addColorLime">
                                    <label for="addColorLime"></label>
                                </li>
                                <li class="bg-red">
                                    <input type="radio" data-color="bg-red" name="colorChosen" id="addColorRed">
                                    <label for="addColorRed"></label>
                                </li>
                                <li class="bg-purple">
                                    <input type="radio" data-color="bg-purple" name="colorChosen" id="addColorPurple">
                                    <label for="addColorPurple"></label>
                                </li>
                                <li class="bg-fuchsia">
                                    <input type="radio" data-color="bg-fuchsia" name="colorChosen" id="addColorFuchsia">
                                    <label for="addColorFuchsia"></label>
                                </li>
                                <li class="bg-muted">
                                    <input type="radio" data-color="bg-muted" name="colorChosen" id="addColorMuted">
                                    <label for="addColorMuted"></label>
                                </li>
                                <li class="bg-navy">
                                    <input type="radio" data-color="bg-navy" name="colorChosen" id="addColorNavy">
                                    <label for="addColorNavy"></label>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success save-event">Save</button>
                    <button type="button" class="btn btn-danger delete-event" data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../js/calendar.js"></script>
<?php
include('footer.php');
?>