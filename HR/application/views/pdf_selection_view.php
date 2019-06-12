<div class="pdf-header-main">
      Prepare PDF
</div>
<form action="/HR/PDF/print" method="post">
      <div class="pdf-parameter-card">
            <div class="pdf-header">
                  Mitarbeiter
            </div>

            <div style="padding:10px; background: lightblue; height:50vh; overflow-y: scroll">
                  <?php foreach ($this->list as $employee) : ?>
                        <div class="pdf-selection-card">
                              <div class="pdf-checkbox">
                                    <input type="checkbox" name=<?php print htmlentities("Id[]" . $employee->Id) ?> value=<?php print htmlentities($employee->Id) ?>>
                              </div>
                              <div class="pdf-value">
                                    <?php print htmlentities($employee->Name . " " . $employee->LastName); ?>
                              </div>
                              <div style="display:inline-block; float:right; padding-right:10px; line-height:30px">
                                    <?php print htmlentities($employee->Id) ?>
                              </div>
                        </div>
                  <?php endforeach ?>
            </div>

            <div style="width: 280px; margin:0 auto; ">
                  <div style="display:inline-block;">
                        <button class="btn btn-primary pdf-button" type="button">Select All</button>
                  </div>
                  <div style="display:inline-block; ">
                        <button class="btn btn-danger pdf-button" type="button">Unselect All</button>
                  </div>
            </div>
      </div>

      <div class="pdf-parameter-card" style="display:inline-block; ">
            <div class="pdf-header">
                  Datei
            </div>
            <div>
                  <div class="pdf-selection-card">
                        <div class="pdf-checkbox">
                              <input type="checkbox" name="PersonalData" value="1">
                        </div>
                        <div class="pdf-value">
                              Personalien
                        </div>
                  </div>

                  <div class="pdf-selection-card">
                        <div class="pdf-checkbox">
                              <input type="checkbox" name="Career" value="1">
                        </div>
                        <div class="pdf-value">
                              Arbeit
                        </div>
                  </div>

                  <div class="pdf-selection-card">
                        <div class="pdf-checkbox">
                              <input type="checkbox" name="ForeignPassport" value="1">
                        </div>
                        <div class="pdf-value">
                              Pass-Angaben
                        </div>
                  </div>

                  <div class="pdf-selection-card">
                        <div class="pdf-checkbox">
                              <input type="checkbox" name="Children" value="1">
                        </div>
                        <div class="pdf-value">
                              Kinder
                        </div>
                  </div>

                  <div class="pdf-selection-card">
                        <div class="pdf-checkbox">
                              <input type="checkbox" name="SwissVisit" value="1">
                        </div>
                        <div class="pdf-value">
                              Schweiz-Aufenthalte
                        </div>
                  </div>
            </div>
      </div>
      <input type="submit">
</form>