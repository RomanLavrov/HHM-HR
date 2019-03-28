<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
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
            <form action="/HR/editvacations" method="post">
                  <div id="vacations-scroll">
                        <?php $vacationCounter = 1?>
                        <?php if (sizeof($this->employee->Vacations) > 0): ?>
                        <?php foreach ($this->employee->Vacations as $vacation): ?>

                        <div class="create-personal-vacation" style="box-shadow: none;">
                              <div class="row" style="padding: 0 10px 0 0;">
                                    <div class="col-md-2" style="margin: 0px; padding:0px; ">
                                          <div class="vacation-label">
                                                <div class="vacation-number">
                                                      <?php print htmlentities($vacationCounter++)?>
                                                </div>

                                                <div class="vacation-bucket">
                                                      <button class="btn-del-vacation" type="button"></button>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="col-md-10" style="margin-left:0px; padding-left:0px;">
                                          <div class="bio-description">Start</div>
                                          <div class='bio-value bio-value-datepicker'>
                                                <input class="form-control" type="text"
                                                      name=<?php print htmlentities("Start" . $vacationCounter)?>
                                                      value='<?php print htmlentities(($vacation->StartDate))?>'>
                                          </div>
                                          <div class="bio-description">End</div>
                                          <div class='bio-value bio-value-datepicker'>
                                                <input class="form-control" type="text"
                                                      name=<?php print htmlentities("End" . $vacationCounter)?>
                                                      value=<?php print htmlentities(($vacation->StartDate))?>>
                                          </div>
                                          <div class="bio-value-duration">
                                                <?php print htmlentities((((new DateTime(($vacation->StartDate)))->modify('-1 day'))->diff(new DateTime($vacation->EndDate)))->format('%d Tage'))?>
                                          </div>
                                    </div>
                              </div>
                        </div>

                        <?php endforeach;?>
                        <?php endif;?>

                        <!-- <div  id="vacation-parent"></div> -->
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
                                    <div class="calendar-day" data-weekday=<?php echo ($day->WeekDay) ?>
                                          data-today=<?php echo ($day->Today) ?>
                                          data-vacation=<?php echo ($day->Vacation) ?>
                                          data-sickleave=<?php echo ($day->SickLeave) ?>>
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
      <div class="row"  style="padding: 0 10px 0 0; ">
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
                  <div class="bio-description">Start</div>
                  <div class="bio-value bio-value-datepicker">
                        <input class="form-control" type="text" name=<?php print htmlentities("Start" . $vacationCounter)?>>
                  </div>
                  <div class="bio-description">End</div>
                  <div class="bio-value bio-value-datepicker">
                        <input class="form-control" type="text" name=<?php print htmlentities("End" . $vacationCounter)?>>
                  </div>
                  <!-- <div class="bio-description">Dauer</div> -->
                  <div class="bio-value-duration">
                        0 Tage
                        <!-- <?php print htmlentities((((new DateTime(($vacation->StartDate)))->modify('-1 day'))->diff(new DateTime($vacation->EndDate)))->format('%d Tage'))?> -->
                  </div>
            </div>
      </div>
      </div>
</div>

<script src="/HR/js/calendar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>