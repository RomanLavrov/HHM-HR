<table class="table table-striped table-bordered table-light" style="width:1840px">

      <thead class="thead-dark" style="display:block; text-align:center">
            <tr class="vacationMonthHeader" style="text-align:center; vertical-align:top">
                  <th style="width:420px;">Mitarbeiter</th>
                  <th style="width:150px;">Zusammen</th>
                  <th style="width:150px;">Zugewiesen</th>
                  <th style="width:150px;">Nicht Zugewiesen</th>
                  <th style="width:100px;">Januar</th>
                  <th style="width:100px;">Februar</th>
                  <th style="width:100px;">März</th>
                  <th style="width:100px;">April</th>
                  <th style="width:100px;">Mai</th>
                  <th style="width:100px;">Juni</th>
                  <th style="width:100px;">Juli</th>
                  <th style="width:100px;">August</th>
                  <th style="width:100px;">September</th>
                  <th style="width:100px;">Oktober</th>
                  <th style="width:100px;">November</th>
                  <th style="width:100px;">Dezember</th>
            </tr>
      </thead>
      <tbody style="display:block; height:90vh; overflow: auto;width:1840px">

            <?php foreach ($this->list as $employee): ?>
            <tr>
                  <td style="width:320px;">
                        <form action="/HR/calendar" method="post" style="width:300px;">
                              <button class="employee-name" type="submit">
                                    <img class="employee-photo" src=<?php print htmlentities($employee->Photo);?>
                                          alt="">
                                    <div style="display:inline-block"><?php print htmlentities($employee->Name);?></div>
                                    <div style="display:inline-block"><?php print htmlentities($employee->LastName);?></div>
                                    <input name="idEmployee" type="hidden" value=<?php print htmlentities($employee->ID);?>>
                              </button>

                        </form>
                  </td>
                  <td class="vacationMonthTotal" style="width:150px;line-height:70px; font-size:16pt;"><?php print htmlentities($employee->Total);?></td>
                  <td class="vacationMonthTotal" style="width:150px;line-height:70px; font-size:16pt;"><?php print htmlentities($employee->Used);?></td>
                  <td class="vacationMonthTotal" style="width:150px;line-height:70px; font-size:16pt;"><?php print htmlentities($employee->NotUsed);?></td>
                  <?php foreach ($employee->Duration as $duration): ?>
                  <td class="vacationMonth" style="width:100px; line-height:70px; font-size:16pt;"><?php print htmlentities($duration);?></td>
                  <?php endforeach?>
            </tr>
            <?php endforeach;?>
      </tbody>
</table>

<script src="/HR/js/vacation.js"></script>