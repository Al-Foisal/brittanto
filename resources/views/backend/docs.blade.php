@extends('layouts.backend')

@section('title') User manual @stop

@section('css')
<style>
	
</style>
@stop
@section('foisal')
<div class="row">

	<div class="card mb-3">
		<div class="card-header">
			<h3>Student</h3>
		</div>
		
		<div class="card-body">

			<h5 class="card-title">Fornt</h5>
			<p class="card-text">
				student details এ সকল student এর তালিকা থাকবে। 

				student এর তালিকা সাজানো থাকবে class -> batch -> student list.

				এখানে প্রত্যেকটি class এর under এ কতটি batch এবং প্রতিটি batch এর  under এ কতজন student,batch type এবং gender আছে এগুলো  title থেকে জানা যাবে।

				প্রতিটি batch এর জন্য attendence sheet print করা যাবে এবং প্রতি test বা exam এর number input দেওয়ার পরে sms  পাঠানো যাবে(sent sms from here button)এবং student  এর details, edit and delete operation এখান থেকেই করা যাবে।
			</p>
			<hr>

			<h5 class="card-title">Add Student</h5>
			<p class="card-text">
				Student admission form  এ সকল data সতর্কতার সাথে  input দিতে হবে শুধুমাত্র optional অংশগুলো ছাড়া।

				optional অংশগুলো input না দিলেও সমস্যা নেই এবং এর জন্য system এর কোনো ব্যাঘাত ঘটবে না। 

				ভর্তি নেওয়ার সময় tution fee এখানেই input দিতে হবে। 

				একজন student কে যেকোন batch এ regular অথবা special student হিসেবে ভর্তি করানো যাবে।
				<div class="p-3 mb-2 bg-danger text-white">
					most important issue হচ্ছে, একটা class এর under এ student ভর্তি নেওয়ার আগে অবশ্যই সেই class এর under এ batch create করতে হবে।

					এই শর্ত সকল class এর student ভর্তির জন্য প্রযোয্য।
				</div>
			</p>
			<hr>

			<h5 class="card-title">Student details</h5>
			<p class="card-text">
				details option থেকে একজন student এর সকল তথ্য এবং কার্যক্রম যেমন, receipt details ও exam details পাওয়া যাবে এবং এগুলো pdf আকারে পাওয়া যাবে।
			</p>
			<hr>

			<h5 class="card-title">Delete student</h5>
			<p class="card-text">
				delete option থেকে  student delete করা যাবে with alert message.
			</p>
		</div>
	</div>

	<hr>

	<div class="card mb-3">
		<div class="card-header">
			<h3>Employee</h3>
		</div>

		<div class="card-body">

			<h5 class="card-title">Fornt</h5>
			<p class="card-text">
				employee option এ সকল empolyee(i.e.teacher,staff)দের list থাকবে।per day teacher payment এর হিসাব এখান থেকে করা যাবে।
			</p>
			<hr>

			<h5 class="card-title">Per day salary</h5>
			<p class="card-text">
				per day teacher form এ শুধুমাত্র class  number এবং bonus (if any) bonus input দিয়ে submit করতে হবে এবং submitted salary payment  form এর নিচে pending (not paid) অবস্থায় দেখাবে। 

				pending salary paid না করলে এটি voucher sheet এ add হবে না paid করার জন্য pending button এ click করতে হবে,অবশ্যই এই process এর জন্য alert থাকবে।

				আর যারা fixed paid empoyee(i.e.teacher,staff)তাদের salary automatic voucher sheet এ add hoye jabe.
			</p>
			<hr>

			<h5 class="card-title">Add employee</h5>
			<p class="card-text">
				employee নিয়োগ দেওয়ার সময় teacher এবং staff হিসাবে ভাগ হয়ে যাবে।যেখানে staff দের বেতন সর্বক্ষণ fixed থাকবে এবং teacher দের বেতন  fixed payment অথবা per class paymeent আকারে থাকবে।

				fixed payment এবং per class payment সতর্কতার সাথে input দিতে হবে।
			</p>
			<hr>

			<h5 class="card-title">Delete employee</h5>
			<p class="card-text">
				delete option থেকে  employee delete করা যাবে with alert message.
			</p>
		</div>
	</div>

	<hr>

	<div class="card mb-3">
		<div class="card-header">
			<h3>Owner</h3>
		</div>

		<div class="card-body">

			<h5 class="card-title">Fornt</h5>
			<p class="card-text">
				owner option এ ownerদের  কিছু তথ্য থাকবে এবং প্রত্যেকটি owner এর একটি করে বাণী বা উক্তি থাকবে।এই বাণী বা উক্তিগুলো  owner add করার সময় দেওয়া হবে এবং এই বাণী বা উক্তি publicly show করবে।
			</p>
		</div>
	</div>

	<hr>

	<div class="card mb-3">
		<div class="card-header">
			<h3>Batch</h3>
		</div>

		<div class="card-body">

			<h5 class="card-title">Fornt</h5>
			<p class="card-text">
				batch option এ সকল batch এর list থাকবে।

				এখান থেকে batch শুধুমাত্র update এবং নতুন batch add করা যাবে কিন্তু batch delete করা যাবে না। batch add  করার সময়  batch number বা batch name automatic তৈরী হবে এবং প্রয়োজনীয় তথ্যাদি দিয়ে form submit করতে হবে।
			</p>
		</div>
	</div>

	<hr>

	<div class="card mb-3">
		<div class="card-header">
			<h3>Exam Area</h3>
		</div>

		<div class="card-body">

			<h5 class="card-title">Fornt</h5>
			<p class="card-text">
				exam area তে শুধুমাত্র exam title গুলো থাকবে যা চাইলে delete করা যাবে। যেখানে  exam title এর নাম হবে "test" key word দিয়ে এবং numbering হবে automatically. নতুন exam title add korte শুধুমাত্র exam date এবং exam time দিতে হবে,এর সাথে  exam title automatically চলে আসবে।
			</p>

			<hr>
			<h5 class="card-title">Test details</h5>
			<p class="card-text">
				প্রতিটি test এর under এ details দিতে হবে,details এ থাকবে subject এর নাম according to class and batch. অর্থাৎ ঐ test এর under এ যতগুলো subject পরীক্ষা নেওয়া হবে সেই subject গুলো add করতে হবে।এই subject এর প্রতিটি student এর mark add করার জন্য add number option এ যেতে হবে।যেখানে test details থাকবে এবং যে batch এর জন্য পরীক্ষা নেওয়া হয়েছে সেই সকল student এর number input দেওয়ার জন্য id অনুযায়ী একটি form থাকবে এবং obtain number গুলো input দিয়ে form submit করতে হবে।যদি কোন student এর number ভুল হয় তাহলে ঐ subject এর exam details option থেকে number update করা যাবে।চাইলে প্রতিটি test এর under এ subject গুলো delete করা যাবে।
				<hr>
				<div class="p-3 mb-2 bg-danger text-white">
					important issue, যে একটি test এর under এ যে সকল class এবং batch এর জন্য subject input দেওয়া আছে সেই সকল subject এর mark input দেওয়ার পরে ঐ class এবং batch এর  student দের কাছে sms পাঠানো যাবে।
				</div>
			</p>

			<hr>
			<h5 class="card-title">Money receipt</h5>
			<p class="card-text">
				money receipt এর option এ একটি money receipt এর format থাকবে, যেখানে money receipt এর cost title হবে make money receipt option থেকে আসা title গুলো কিন্তু tution fee থাকবে না। কারন এটা একটি student এর money receipt ওঠানোর সময় automatically চলে আসবে।
				<hr>
				receipt option শুধুমাত্র student id দিয়ে receipt ওঠাতে হবে।paid receipt option এ সকল paid receipt এর তালিকা থাকবে।
			</p>
		</div>
	</div>

	<hr>

	<div class="card mb-3">
		<div class="card-header">
			<h3>Finance</h3>
		</div>
		
		<div class="card-body">

			<h5 class="card-title">Fornt</h5>
			<p class="card-text">
				finance option এ একটি voucher form এর সাথে voucher table থাকবে।যেখানে daily cost এবং extra income add করা  যাবে।

				cost sheet option এ সকল আয় ব্যয়ের চড়ান্ত হিসাব থাকবে।
			</p>
		</div>
	</div>

	<hr>

	<div class="card mb-3">
		<div class="card-header">
			<h3>User Pages</h3>
		</div>
		
		<div class="card-body">

			<h5 class="card-title">Fornt</h5>
			<p class="card-text">
				user pages option এর সকল content publicly show করবে।
			</p>

			<hr>

			<h5 class="card-title">Edu. Solution</h5>
			<p class="card-text">
				educational solution এ মোট তিনটি কৌশল দেওয়া থাকবে যেটা লিখিতভাবে সংক্ষিপ্ত কিন্তু অর্থবহ হবে, যেটা শিক্ষার্থীদের পড়াশোনা, আদবকায়দা এবং আপনার প্রতিষ্ঠানের শিক্ষার সর্বোত্তম মান নিশ্চিত করবে।
			</p>

			<hr>

			<h5 class="card-title">Course & Event</h5>
			<p class="card-text">
				courses option এ আপনার প্রতিষ্ঠানের একটি course এর বিস্তারিত বর্ণনা থাকবে। যেখানে অন্তর্ভুক্ত থাকবে একটি course title,course সম্পর্কিত একটি ব্যানার, course টি যাদের জন্য প্রযোয্য,আসন সংখ্যা,duration and fees with proper discription of   respective course. এক category button থেকে course special feature গুলো যুক্ত করতে হবে। উপরের নিয়ম অনুযায়ী নতুন course and features যুক্ত করতে হবে।

				নতুন কোর্স তৈরীর ক্ষেত্রে যে নিয়ম প্রযোয্য event তৈরী ক্ষেত্রে একই নিয়ম প্রযোয্য।
			</p>

			<hr>

			<h5 class="card-title">Notice Board</h5>
			<p class="card-text">
				notice board add করার জন্য একটি notice title and content add করতে হবে।content টি অবশ্যই pdf format এ হতে হবে।
			</p>

			<hr>
		</div>
	</div>

</div>


@stop