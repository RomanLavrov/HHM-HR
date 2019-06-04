<div class="row" style="width:100%">
      <div class="col-md-3" style="min-width: 370px">
            <div class="create-personal">
                  <div class="create-personal-header">Mitarbeiter</div>
                  <div class="personal-image">
                        <img src=<?php print htmlentities($this->employee->Photo)?> alt="">
                  </div>
                  <div class="bio-description">Name</div>
                  <div class="bio-value"><?php print htmlentities($this->employee->Name)?></div>
                  <div class="bio-description">Vorname</div>
                  <div class="bio-value"><?php print htmlentities($this->employee->LastName)?></div>
            </div>
            <form action="/HR/editsick" method="post">
                  <div class="create-personal-header">Krankenstand</div>
                  <div id="vacations-scroll">
                        <?php $sickLeavesCounter = 1?>
                        <?php if (sizeof($this->employee->SickList) > 0): ?>
                        <?php foreach ($this->employee->SickList as $sickList): ?>
                        <?php $sickLeavesCounter++?>
                        <div class="create-personal-vacation">
                              <div class="row" style="padding: 0 10px 0 0; ">
                                    <div class="col-md-2" style="margin: 0px; padding:0px; ">
                                          <div class="vacation-label">
                                                <div class="vacation-number">
                                                      <?php print htmlentities($sickLeavesCounter)?>
                                                </div>

                                                <div class="vacation-bucket">
                                                      <button class="btn-del-vacation" type="button"></button>
                                                </div>
                                          </div>
                                    </div>

                                    <div class="col-md-10"
                                          style="margin-left:0px; padding-left:0px; padding-right:15px;">

                                          <div class="input-daterange input-group" id="datepicker">
                                                <div class="bio-description">Start</div>
                                                <input type="text" class="bio-value"
                                                      name=<?php print htmlentities("Start" . $sickLeavesCounter)?>
                                                      value=<?php print htmlentities((new DateTime($sickList->StartDate))->format('d-F-Y'))?>>
                                                <div class="bio-description">End</div>
                                                <input type="text" class="bio-value"
                                                      name=<?php print htmlentities("End" . $sickLeavesCounter)?>
                                                      value=<?php print htmlentities((new DateTime($sickList->EndDate))->format('d-F-Y'))?>>
                                          </div>

                                          <div class="bio-value-duration">
                                                <?php print htmlentities((((new DateTime(($sickList->StartDate)))->modify('-1 day'))->diff(new DateTime($sickList->EndDate)))->format('%d tage'))?>
                                          </div>

                                    </div>
                              </div>
                        </div>

                        <?php endforeach;?>
                        <?php endif;?>
                  </div>
                  <input type="hidden" name=<?php print htmlentities("Id")?> id=""
                        value=<?php print htmlentities($this->employee->Id)?>>

                  <button id="btn-add-vacation" class="button-add" type="button"></button>
                  <button id="btn-save-vacation" class="button-add" type="submit"></button>
            </form>

      </div>
      <div class="col-md-9">
            <div class="create-personal">
                  <div class="create-personal-header">
                        Kalendar
                  </div>
                  <div class="calendar-year">
                        <?php foreach ($this->calendar->Year as $month): ?>
                        <div class="calendar-month">
                              <h1><?php print htmlentities($month->MonthHeader);?></h1>
                              <?php foreach ($month->WeekDayHeader as $weekHeader): ?>
                              <div class="calendar-day-header"><?php print htmlentities($weekHeader);?></div>
                              <?php endforeach?>
                              <?php foreach ($month->MonthDays as $week): ?>
                              <div>
                                    <?php foreach ($week as $day): ?>
                                    <div class="calendar-day" data-weekday=<?php print htmlentities ($day->WeekDay);?>
                                          data-today=<?php print htmlentities ($day->Today);?> data-vacation="false"
                                          data-sickleave=<?php print htmlentities ($day->SickLeave);?>
                                          data-holiday=<?php print htmlentities ($day->Holiday)?>>
                                          <?php echo ($day->Date) ?>
                                    </div>
                                    <?php endforeach?>
                              </div>
                              <?php endforeach?>
                        </div>
                        <?php endforeach?>
                  </div>
            </div>
      </div>
</div>

<div id="vacation" style="visibility:collapse;">
<div class="create-personal-vacation" style="box-shadow: none;">
            <div class="row" style="padding: 0 10px 0 0; ">
                  <div class="col-md-2" style="margin: 0px;  padding:0px; ">
                        <div class="vacation-label">
                              <div class="vacation-number">
                                    <?php print htmlentities($vacationCounter++)?>
                              </div>

                              <div class="vacation-bucket">
                                    <button class="btn-del-vacation" type="button"></button>
                              </div>
                        </div>
                  </div>
                  <div class="col-md-10" style="margin:0; padding-left:0;">

                        <div class="input-daterange input-group" id="datepicker">
                              <div class="bio-description">Start</div>
                              <input type="text" class="bio-value"
                                    name=<?php print htmlentities("Start" . $vacationCounter)?>>
                              <div class="bio-description">End</div>
                              <input type="text" class="bio-value"
                                    name=<?php print htmlentities("End" . $vacationCounter)?>>
                        </div>                     

                        <!-- <div class="bio-description">Dauer</div> -->
                        <div class="bio-value-duration">
                              0 Tage
                              <!--<?php print htmlentities((((new DateTime(($vacation->StartDate)))->modify('-1 day'))->diff(new DateTime($vacation->EndDate)))->format('%d Tage'))?> -->
                        </div>
                  </div>
            </div>
      </div>
</div>

<script src="/HR/js/calendar.js"></script>