@extends('app')

@section('page-title')
       <h1>מפת מוסדות המחוז</h1>
@stop

@section('content')
<article class="main-content">
            <img id="Image-Maps-Com-image-maps-2015-03-21-143528" src="../images/map_with_cities2.jpg" border="0" width="802" height="1034" orgWidth="802" orgHeight="1034" usemap="#image-maps-2015-03-21-143528" alt="" />
            <map name="image-maps-2015-03-21-143528" id="ImageMapsCom-image-maps-2015-03-21-143528">
            <area shape="rect" coords="800,1032,802,1034" alt="Image Map" style="outline:none;" title="Image Map" href="http://www.image-maps.com/index.php?aff=mapped_users_0" />
            <area id="ashdod" alt="" title="אשדוד" href="{{route('shapah.show', 4)}}" shape="poly" coords="376,20,376,11,364,14,364,23,356,28,360,41,406,41,406,30,381,25" style="outline:none;" target="_self"     />
            <area id="beer_tuvia" alt="" title="באר טוביה" href="{{route('shapah.show', 7)}}" shape="poly" coords="442,33,443,44,450,44,453,33,516,31,513,14,434,15,431,26" style="outline:none;" target="_self"     />
            <area id="yoav" alt="" title="יואב" href="{{route('shapah.show', 15)}}" shape="poly" coords="568,36,615,35,616,51,568,50" style="outline:none;" target="_self"     />
                <area id="kiryat_malachi" alt="" title="קרית מלאכי" href="{{route('shapah.show', 30)}}" shape="poly" coords="522,72,626,74,626,87,525,85" style="outline:none;" target="_self"     />
<area id="shafir" alt="" title="שפיר" href="{{route('shapah.show', 37)}}" shape="poly" coords="428,80,428,70,418,70,417,80,404,81,403,93,443,95,443,81" style="outline:none;" target="_self"     />
<area id="ashkelon" alt="" title="אשקלון" href="{{route('shapah.show', 6)}}" shape="poly" coords="302,72,303,87,360,86,360,75,322,70,318,56" style="outline:none;" target="_self"     />
<area id="lahish" alt="" title="לכיש" href="{{route('shapah.show', 19)}}" shape="poly" coords="525,126,584,127,585,137,528,136" style="outline:none;" target="_self"     />
<area id="kiryat_gat" alt="" title="קרית גת" href="{{route('shapah.show', 29)}}" shape="poly" coords="444,124,434,124,434,133,406,137,406,148,468,151,470,140,447,137" style="outline:none;" target="_self"     />
<area id="hof_ashkelon" alt="" title="חוף אשקלון" href="{{route('shapah.show', 13)}}" shape="poly" coords="297,110,346,111,346,145,291,143,292,127,318,126,307,120" style="outline:none;" target="_self"     />
<area id="har_hevron" alt="" title="הר חברון" href="{{route('shapah.show', 11)}}" shape="poly" coords="561,162,644,161,648,176,562,176" style="outline:none;" target="_self"     />
                <area id="arad" alt="" title="ערד" href="{{route('shapah.show', 27)}}" shape="poly" coords="628,213,674,213,674,225,631,225" style="outline:none;" target="_self"     />
<area id="bney_shimon" alt="" title="בני שמעון" href="{{route('shapah.show', 9)}}" shape="poly" coords="492,202,492,194,482,193,481,204,451,205,457,221,528,220,528,208" style="outline:none;" target="_self"     />
<area id="shaar_hanegev" alt="" title="שער הנגב" href="{{route('shapah.show', 36)}}" shape="poly" coords="361,202,360,190,351,191,348,204,325,206,326,218,402,220,401,206" style="outline:none;" target="_self"     />
<area id="sderot" alt="" title="שדרות" href="{{route('shapah.show', 35)}}" shape="poly" coords="254,184,253,170,243,173,240,186,226,186,226,200,280,198,281,188" style="outline:none;" target="_self"     />
<area id="meitar" alt="" title="מיתר" href="{{route('shapah.show', 21)}}" shape="poly" coords="556,256,611,258,613,270,560,265" style="outline:none;" target="_self"     />
<area id="lakia" alt="" title="לקיה" href="{{route('shapah.show', 20)}}" shape="poly" coords="470,261,468,254,457,254,456,262,444,264,443,277,481,280,482,267,468,265" style="outline:none;" target="_self"     />
<area id="rahat" alt="" title="רהט" href="{{route('shapah.show', 31)}}" shape="poly" coords="370,272,370,260,358,263,361,272,346,273,347,287,383,287,381,274" style="outline:none;" target="_self"     />
<area id="netivot" alt="" title="נתיבות" href="{{route('shapah.show', 23)}}" shape="poly" coords="283,243,282,227,271,228,270,245,253,243,255,258,308,258,308,245" style="outline:none;" target="_self"     />
<area id="sdot_negev" alt="" title="שדות נגב" href="{{route('shapah.show', 34)}}" shape="poly" coords="190,228,190,220,177,221,180,231,152,237,152,251,225,250,225,235,193,233" style="outline:none;" target="_self"     />
<area id="tamar" alt="" title="תמר" href="{{route('shapah.show', 39)}}" shape="poly" coords="676,313,673,303,663,303,667,320,653,320,655,332,690,332,686,320,674,320" style="outline:none;" target="_self"     />
<area id="hura" alt="" title="חורה" href="{{route('shapah.show', 14)}}" shape="poly" coords="557,300,612,300,614,315,560,312" style="outline:none;" target="_self"     />
<area id="omer" alt="" title="עומר" href="{{route('shapah.show', 25)}}" shape="poly" coords="480,335,533,337,537,347,481,346" style="outline:none;" target="_self"     />
<area id="lehavim" alt="" title="להבים" href="{{route('shapah.show', 18)}}" shape="poly" coords="337,321,404,321,405,336,343,336" style="outline:none;" target="_self"     />
<area id="ofakim" alt="" title="אופקים" href="{{route('shapah.show', 2)}}" shape="poly" coords="284,295,284,283,270,283,272,296,247,297,251,308,304,311,304,298" style="outline:none;" target="_self"     />
<area id="merhavim" alt="" title="מרחבים" href="{{route('shapah.show', 22)}}" shape="poly" coords="195,294,195,281,184,282,183,295,153,297,153,311,215,311,216,298" style="outline:none;" target="_self"     />
<area id="kseyfe" alt="" title="כסייפה" href="{{route('shapah.show', 17)}}" shape="poly" coords="613,371,610,360,597,363,598,374,582,376,582,390,636,387,636,377,610,375" style="outline:none;" target="_self"     />
<area id="beer_sheva" alt="" title="באר שבע" href="{{route('shapah.show', 8)}}" shape="poly" coords="440,390,438,376,428,376,428,392,402,392,405,407,477,407,474,395,434,391" style="outline:none;" target="_self"     />
<area id="neve_midbar" alt="" title="נווה מדבר" href="{{route('shapah.show', 24)}}" shape="poly" coords="345,387,332,388,331,406,285,405,285,390,297,387,300,368,328,370,332,381,344,378" style="outline:none;" target="_self"     />
<area id="eshkol" alt="" title="אשכול" href="{{route('shapah.show', 5)}}" shape="poly" coords="207,374,206,360,197,361,195,378,175,376,177,391,225,393,224,380,205,374" style="outline:none;" target="_self"     />
<area id="elkasum" alt="" title="אלקסום" href="{{route('shapah.show', 1)}}" shape="poly" coords="553,417,551,408,543,406,543,423,525,422,526,436,585,436,583,424,550,418" style="outline:none;" target="_self"     />
<area id="arara" alt="" title="ערערה" href="{{route('shapah.show', 28)}}" shape="poly" coords="553,482.00000089480534,551,468.00000089480534,540,468.00000089480534,542,484.00000089480534,522,484.00000089480534,523,498.00000089480534,576,497.00000089480534,575,486.00000089480534" style="outline:none;" target="_self"     />
<area id="segev_shalom" alt="" title="שגב שלום" href="{{route('shapah.show', 33)}}" shape="poly" coords="430,473.00000089480534,425,461.00000089480534,415,464.00000089480534,415,475.00000089480534,391,476.00000089480534,390,492.00000089480534,466,491.00000089480534,467,478.00000089480534,427,475.00000089480534" style="outline:none;" target="_self"     />
<area id="tel_sheva" alt="" title="תל שבע" href="{{route('shapah.show', 38)}}" shape="poly" coords="308,451.00000089480534,306,438.00000089480534,297,438.00000089480534,296,451.00000089480534,268,453.00000089480534,271,466.00000089480534,331,465.00000089480534,331,457.00000089480534,306,454.00000089480534" style="outline:none;" target="_self"     />
<area id="dimona" alt="" title="דימונה" href="{{route('shapah.show', 10)}}" shape="poly" coords="473,538.0000008948053,471,528.0000008948053,462,531.0000008948053,461,543.0000008948053,444,543.0000008948053,444,555.0000008948053,494,556.0000008948053,495,543.0000008948053,472,543.0000008948053" style="outline:none;" target="_self"     />
<area id="ramat_negev" alt="" title="רמת נגב" href="{{route('shapah.show', 32)}}" shape="poly" coords="328,521.0000013422081,328,508.00000134220807,321,510.00000134220807,316,522.0000013422081,291,524.0000013422081,290,538.0000013422081,368,538.0000013422081,367,527.0000013422081,325,522.0000013422081" style="outline:none;" target="_self"     />
<area id="arava_tichona" alt="" title="ערבה תיכונה" href="{{route('shapah.show', 26)}}" shape="poly" coords="535,623.0000013422081,521,623.0000013422081,521,607.0000013422081,476,607.0000013422081,472,623.0000013422081,468,644.0000013422081,521,646.0000013422081,522,631.0000013422081,535,631.0000013422081" style="outline:none;" target="_self"     />
<area id="yeruham" alt="" title="ירוחם" href="{{route('shapah.show', 16)}}" shape="poly" coords="364,588.0000013422081,362,574.0000013422081,351,574.0000013422081,347,590.0000013422081,338,591.0000013422081,338,605.0000013422081,384,604.0000013422081,383,592.0000013422081,361,592.0000013422081" style="outline:none;" target="_self"     />
<area id="mitzpe_ramon" alt="" title="מצפה רמון" href="{{route('shapah.show', 40)}}" shape="poly" coords="398,663.0000013422081,397,648.0000013422081,382,650.0000013422081,384,664.0000013422081,352,664.0000013422081,352,676.0000013422081,434,680.0000013422081,432,666.0000013422081" style="outline:none;" target="_self"     />
<area id="hevel_eilot" alt="" title="חבל אילות" href="{{route('shapah.show', 12)}}" shape="poly" coords="444,755.0000013422081,444,740.0000013422081,432,740.0000013422081,431,754.0000013422081,411,757.0000013422081,410,772.0000013422081,490,768.0000013422081,490,758.0000013422081" style="outline:none;" target="_self"     />
<area id="eilat" alt="" title="אילת" href="{{route('shapah.show', 3)}}" shape="poly" coords="450,913.0000017896107,448,893.0000017896107,464,894.0000017896107,462,880.0000017896107,426,880.0000017896107,426,892.0000017896107,442,897.0000017896107,442,911.0000017896107" style="outline:none;" target="_self"     />
            </map>




@stop
