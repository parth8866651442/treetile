<div class="row">
  <div class="col-lg-8 col-md-8 col-sm-12">
    <div class="c-main">
      <div class="c-half c-full">
        <div class="c-row">
          <h4 class="c-title">Box Calculation</h4>
        </div>
        <div class="c-row ">
          <label class="c-label">Length</label>
          <input id="SLength"  name="SLength" class="m-input" />
          <span>Feet</span> 
        </div>
        <div class="c-row ">
          <label class="c-label">Width</label>
          <input id="SWidth" name="SWidth" class="m-input" >
          <span>Feet</span> 
        </div>
        <div class="c-row">
          <label class="c-label">Tiles Size</label>
          <select id="sizes"  class="m-input" name="sizes">
            <?php $calcdata = $obj_fun->get_calc_info_data();
        
          if(isset($calcdata) && count($calcdata) > 0 && $calcdata != ''){
            
            foreach($calcdata as $cdata){
            
            echo '<option value="'.$cdata['packing_size'].'" data-picperbox="'.$cdata['packing_number'].'">'.$cdata['size'].' [ '.$cdata['name'].' ]'.'</option>';    
            
            }
          }
        
         ?>
          </select>
        </div>
        <br>
        <div class="c-row mt10 text-left">
          <input name="Button1" id="Button1" class="button_cal" onClick="calculate()" value="Calculate" type="button"  style="margin-top:0 !important">

        </div>
      </div>
      <div class="c-result">
        <div id="Results" >
          <div class="c-row">
            <h4 class="c-title">Calculations</h4>
          </div>
          <div class="c-row ">
            <label class="c-label" style="text-align: left">Total Area Covered</label>
            <input class="m-input" maxlength="10" name="ar_mtr" id="ar_mtr" readonly size="6" style="width: 50%">
            <span>Sq. M</span>
            <label class="c-label" style="text-align: left">&nbsp;</label>
            
            <input id="ar_feet" class="m-input" maxlength="10" name="ar_feet" readonly size="6" style="width: 50%">
            <span>Sq. Ft</span> </div>
          <div class="c-row ">
            <label class="c-label t-left">Required Tiles</label>
            <input class="m-input" maxlength="10" name="TotalTiles" id="TotalTiles" readonly size="10" style="width: 60%">
          </div>
          <div class="c-row ">
            <label class="c-label t-left">Required Boxes</label>
            <input id="TotalBoxes" class="m-input" maxlength="10" name="TotalBoxes" readonly size="10" style="width: 60%">
          </div>
          <div class="c-row" style="margin-top:18px">
            <p class="resultp text-center">This may vary on basis of your actual need.This is only approx calculation.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-12 responsivecal">
    <div class="tileDiv mt10">
      <div style="height: 58.2%; width: 80.4%;">
        <p class="tileFt horzFt"><span id="xlength">X ft</span></p>
        <p class="tileFt vertFt"><span id="ylength">Y ft</span></p>
      </div>
    </div>
    <div class="box1 mt30 p10">
      <div class="c-row">
        <h4 class="cal-title">Tips</h4>
      </div>
      <ul class="list" style="padding-left: 20px;">
        <li> Length and Width Dimensions are in feet.</li>
        <li> 1 Feet = 0.3048 Meter</li>
        <li style="margin-bottom:30px !important;"> 1 Meter = 3.28084 Feet</li>
        <br/>
      </ul>
    </div>
  </div>
</div>
