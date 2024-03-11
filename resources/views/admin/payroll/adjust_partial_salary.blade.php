<table class="table table-borderless">
    <thead>
        <tr>
            <th colspan="4" class="text-center">Earning</th>
        </tr>
        <tr class="bg-primary align-items-center">
            <td> <label for="">Salary Component</label></td>
            <td><label for="">Calculation Type</label></td>
            <td><label for="">Monthly Amount</label></td>
            <td> <label for="">Annual Amount</label></td>

        </tr>
    </thead>
    <tbody>

        <tr>
            <td><span>Basic Salary</span></td>
            <td><span>--</span></td>
            <td style="width:20%;"><input type=" text" class="form-control height-35 f-14" name="slack_username" id="monthly_amount" value="{{$basic_salary}}" readonly=""></td>
            <td style="width:20%;"><input type="text" class="form-control height-35 f-14" name="slack_username" id="annual_amount" value="{{$yearly_salary}}" readonly=""></td>
        </tr>
        <tr>
            <td>Special Allowance</td>
            <td>Special Allowance</td>
            <td id="monthly_allowances">{{$per_month_allowances}}</td>
            <td id="annual_allowances">{{$per_year_allowances}}</td>


        </tr>
        <tr>
            <td><small>(Annual CTC - Sum of all other components)</small></td>
        </tr>
        <tr class="bg-primary">
            <td>
                <h3>Gross Salary</h3>
            </td>
            <td></td>
            <td id="monthly_gross">{{$basic_salary + $per_month_allowances}}</td>
            <td id="annual_gross">{{$yearly_salary + $per_year_allowances}}</td>
        </tr>
        <tr>
            <td colspan="4" class="text-center"><input type="submit" id="cal_sub" class="btn btn-primary" value="Save" /></td>
        </tr>
    </tbody>
</table>