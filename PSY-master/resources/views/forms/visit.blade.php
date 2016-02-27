@extends('app')

@section('page-title')
    <h1>דיווח מפגש פסיכולוג</h1>
@stop

@section('content')
    <!--form-->
    <form class="psy-form" action="{{{route('visit.update',
        $visit->id)}}}" method="post">

        @if(isset($is_new) && !$is_new)
            <input type="hidden" name="_method" value="PUT">
        @endif

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="input-line clearfix">
            <label>תאריך פגישה</label>
            <input type="text" id="datepicker" class="datepicker" size="10" name="date" data-format="YYYY-MM-DD" required value="{{{$visit->date}}}">
        </div>


        <div class="input-line clearfix">
            <label>שם המוסד</label>
            <select name="institute_id" title="שם המוסד" required>
                  <option disabled="disabled" selected="selected" value="">בחר מוסד</option>
                @foreach ($institutes as $ei)
                    <option value="{{{$ei['id']}}}">
                        {{{$ei['name']}}}</option>
                @endforeach
            </select>
        </div>

        <div class="input-line" required>
            <label>שעות שהיה בבית הספר</label>
            <input type="number" name="length" size="1" maxlength="1" min="1" max="8" name="date"
                   value="{{{$visit->length}}}">
        </div>

        <div class="dynamic-list" data-label="סוגי פעילויות">
            <label>דווח פעילות</label>

            <div class="input-line">
                <select name="activity" class="pull-right mult" title="דווח פעילות" required>
                    <option disabled="disabled" selected="selected" value="">בחר פעילות</option>
                    <optgroup label="ועדות /ישיבות">
                        <option>ישיבת צוות בינ-מקצועי + מנהל</option>
                        <option>ישיבת צוות בינ-מקצועי ללא מנהל</option>
                        <option>ועדת שילוב</option>
                        <option>ועדת השמה</option>
                        <option>ועדת החלטה</option>
                        <option>ועדת שיבוצים על יסודי</option>
                        <option>אחר</option>
                    </optgroup>

                    <optgroup label="פגישות">
                        <option>פגישה עם מנהל</option>
                        <option>פגישה עם יועצת</option>
                        <option>פגישה עם גננת</option>
                        <option>פגישה עם מורה</option>
                        <option>אינטייק הורים</option>
                        <option>החזר תוצאות הורים</option>
                        <option>הדרכת הורים</option>
                        <option>אחר</option>
                    </optgroup>

                    <optgroup label="אבחון והערכה">
                        <option>אבחון בשלות</option>
                        <option>אבחון פסיכולוגי מלא</option>
                        <option>אבחון בדגש הערכה רגשית</option>
                        <option>אבחון רב תחומי להערכת לקות למידה</option>
                        <option>הערכה פסיכולוגית לועדת שילוב</option>
                        <option>הערכה פסיכולוגית לועדת השמה</option>
                        <option>(אבחון מערכתי (בי"ס/כתה</option>
                        <option>תצפית</option>
                    </optgroup>

                    <optgroup label="עבודה קבוצתית מערכתית">
                        <option>עבודה קבוצתית עם תלמידים</option>
                        <option>עבודה קבוצתית עם מורים</option>
                        <option>הרצאה למורים</option>
                        <option>הרצאה להורים</option>
                        <option>אחר</option>
                    </optgroup>

                    <optgroup label="טיפול">
                        <option>טיפול פרטני בילד</option>
                        <option>טיפול משפחתי</option>
                        <option>אחר</option>
                    </optgroup>

                    <optgroup label="הפניות">
                        <option>הפניה לפסיכיאטר</option>
                        <option>הפניה לנוירולוג</option>
                        <option>הפניה למכון להתפתחות הילד</option>
                        <option>הפניה למכון להתפתחות הילד</option>
                        <option>הפניה לטיפול פרא רפואי</option>
                        <option>אחר</option>
                    </optgroup>
                </select>

                <textarea name="comment" maxlength="100" placeholder="תאר את הפעילות - עד 100 תווים " cols="40"
                        >{{{$visit->comment}}}</textarea>
                <label>תיאור פעילות</label>
            </div>

        </div>

        <div class="input-line clearfix">
            <button type="submit" class="pull-left approve">שלח</button>
        </div>


    </form> <!-- /form -->

@stop
