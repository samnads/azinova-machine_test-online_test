<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Begin page content -->
<main class="flex-shrink-0 mt-5">
	<div class="container mt-2 text-centr">
		<h1>ONLINE TEST STARTED !</h1>
		<hr>
		<span id="question" class="fw-bold fs-4"></span>
		<br>
		<br>
		<span><input name="answer" class="form-check-input answer" type="radio" value="" onchange="saveAnswer(event.target.value)" id="answerValue1">&nbsp;<span id="answer1"></span>&nbsp;&nbsp;&nbsp;</span>
		<span><input name="answer" class="form-check-input answer" type="radio" value="" onchange="saveAnswer(event.target.value)" id="answerValue2">&nbsp;<span id="answer2"></span>&nbsp;&nbsp;&nbsp;</span>
		<span><input name="answer" class="form-check-input answer" type="radio" value="" onchange="saveAnswer(event.target.value)" id="answerValue3">&nbsp;<span id="answer3"></span>&nbsp;&nbsp;&nbsp;</span>
		<span><input name="answer" class="form-check-input answer" type="radio" value="" onchange="saveAnswer(event.target.value)" id="answerValue4">&nbsp;<span id="answer4"></span>&nbsp;&nbsp;&nbsp;</span>
		<hr class=" mt-6">
		<button type="button" class="btn btn-info" id="prev" onclick="getPrevious(questions[currentIndex-1])">Previous</button>
		<button type="button" class="btn btn-info" id="next" onclick="getNext(questions[currentIndex+1])">Next</button>
		<div class="mt-3">
			<button type="button" class="btn btn-md btn-secondary" id="answered" data-bs-toggle="modal" data-bs-target="#exampleModal1">Answered</button>
			<button type="button" class="btn btn-md btn-secondary" id="unanswered" data-bs-toggle="modal" data-bs-target="#exampleModal2">Unanswered</button>
		</div>
		<div class="submit mt-3">
			<button type="button" class="btn btn-lg btn-success" id="submit" onclick="submit(saved_answers)" disabled>Submit Answers !</button>
			<span id="submit_note" class="text-muted">You must answer all questions to activate submit button !</span>
		</div>
		<div class="countdown text-danger fs-1" id="countdown" style="margin-top:50px;"></div>




		<div class="modal fade" id="exampleModal1" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Answered Questions</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<ul id="answerd_body">
						</ul>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="exampleModal2" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Unanswered Questions</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<ul id="unanswerd_body">
						</ul>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<script>
			<?php
			echo "var questions = " . json_encode($questions) . ";";
			echo "var questions_full = " . json_encode($questions_full) . ";";
			?>
			var currentIndex = -1;
			var answers = [];
			const saved_answers = [];
			var question_answers = [];
			var questions_not_answered = questions_full;
			var questions_answered = [];

			function answerPush(question, answers) {
				if (question_answers.some((data) => data.question === questions[currentIndex])) {} else {
					question_answers.push({
						question: question,
						answers: answers
					});
				}
			}

			function getPrevious(id) {
				currentIndex = currentIndex - 1;
				let index = question_answers.findIndex((item) => item.question === questions[currentIndex]);
				let answers = question_answers[index]['answers'];
				var id = 0;
				for (var key in answers) {
					if (answers.hasOwnProperty(key)) {
						id++;
						document.getElementById("answer" + id).innerHTML = answers[key];
						$('#answerValue' + id).val(key);
					}
				}
				if (saved_answers.some((data) => data.question === questions[currentIndex])) {
					//alert("A")
					resetRadio();
				} else {
					//alert("NA")
					$("input:radio").prop("checked", false); // uncheck all
				}
				hideButton();
				checkAnsweredAll();
			}

			function getNext(id) {
				currentIndex = currentIndex + 1;
				if (question_answers.some((data) => data.question === questions[currentIndex])) {
					let index = question_answers.findIndex((item) => item.question === questions[currentIndex]);
					let answers = question_answers[index]['answers'];
					var id = 0;
					for (var key in answers) {
						if (answers.hasOwnProperty(key)) {
							id++;
							document.getElementById("answer" + id).innerHTML = answers[key];
							$('#answerValue' + id).val(key);
						}
					}
					resetRadio();
				} else {
					$("input:radio").prop("checked", false); // uncheck all
					$.post("ajax/get_question_by_id?get_ques", {
							id: id,
						}, function(data) {}).done(function(data) {
							$("#question").text(data.question.question);
							answerPush(data.question.id, data.answers);
							let index = question_answers.findIndex((item) => item.question === id);
							question_answers_temp = question_answers[index].answers;
							document.getElementById("answer1").innerHTML = question_answers_temp[Object.keys(question_answers_temp)[0]];
							document.getElementById("answer2").innerHTML = question_answers_temp[Object.keys(question_answers_temp)[1]];
							document.getElementById("answer3").innerHTML = question_answers_temp[Object.keys(question_answers_temp)[2]];
							document.getElementById("answer4").innerHTML = question_answers_temp[Object.keys(question_answers_temp)[3]];
							$('#answerValue1').val(Object.keys(data.answers)[0]);
							$('#answerValue2').val(Object.keys(data.answers)[1]);
							$('#answerValue3').val(Object.keys(data.answers)[2]);
							$('#answerValue4').val(Object.keys(data.answers)[3]);
						})
						.fail(function() {});
				}
				hideButton();
				checkAnsweredAll();
			}

			function resetRadio() {
				if (saved_answers.some((data) => data.question === questions[currentIndex])) {
					// previous ques
					let index = saved_answers.findIndex((item) => item.question === questions[currentIndex]);
					//console.log(index)
					var answers_temp = saved_answers[index];
					//console.log(answers_temp['question'])
					//console.log(answers_temp['answer'])
					console.log(question_answers)
					let qIndex = question_answers.findIndex((item) => item.question === answers_temp['question']);
					var answersTemp = question_answers[qIndex]['answers'];
					console.log(answersTemp);
					//var index = answersTemp.findIndex(p => p.attr1 == "john");


					$('input:radio').each(function() {
						console.log(this)
						if (this.value == answers_temp['answer']) {
							$(this).prop("checked", true);
						}
					});


					//$("#answerValue1").prop("checked", true);
					//var index = Object.keys(json).indexOf(keytoFind);
					//document.querySelector('input[name="answer"]:checked').value
				} else {
					//new load
					//alert('new');
					$("input:radio").prop("checked", false);
				}
			}

			function startSession(questions) {
				$.post("ajax/get_all_question_ids?start", function(data) {
						getNext(questions[currentIndex + 1]);
					}).done(function() {})
					.fail(function() {

					});
			}

			function saveAnswer(answer) {
				var test = {};
				test['question'] = questions[currentIndex];
				test['answer'] = answer;
				if (saved_answers.some((data) => data.question === questions[currentIndex])) {
					let index = saved_answers.findIndex((item) => item.question === questions[currentIndex]);
					saved_answers[index].answer = answer;
				} else {
					saved_answers.push(test);
				}
				checkAnsweredAll();

				if (questions_answered.some((data) => data.id === test['question'])) {
					let index = questions_answered.findIndex((item) => item.id === test['question']);
				} else {
					let index = questions_full.findIndex((item) => item.id === test['question']);
					questions_answered.push({
						id: test['question'],
						question: questions_full[index]['question'],
						answer: test['answer']
					});
					let index2 = questions_not_answered.findIndex((item) => item.id === test['question']);
					questions_not_answered.splice(questions_not_answered.findIndex(a => a.id === test['question']), 1)
					console.log(questions_not_answered);
				}
				$("#unanswerd_body").html('');
				questions_not_answered.forEach(function(value, i) {
					$("#unanswerd_body").append('<li class="text-left">' + value['question'] + '</li>');
				});
				$("#answerd_body").html('');
				questions_answered.forEach(function(value, i) {
					$("#answerd_body").append('<li class="text-left">' + value['question'] + '</li>');
				});
			}

			function hideButton() {
				if (currentIndex <= 0) {
					$("#prev").hide();
				} else {
					$("#prev").show();
					if (currentIndex == 9) {
						$("#next").hide();
					} else {
						$("#next").show();
					}
				}
			}

			function checkAnsweredAll() {
				if (saved_answers.length == 10) {
					$("#submit").attr("disabled", false);
					$("#submit_note").hide();
				}
			}

			function submit(answers) {
				$.ajax({
					type: 'post',
					url: "./ajax/submit",
					data: JSON.stringify(answers),
					contentType: "application/json; charset=utf-8",
					traditional: true,
					success: function(data) {
						window.location.href = "./thankyou";
					}
				});
			}
			$(document).ready(function() {
				startSession(questions);
				questions_not_answered.forEach(function(value, i) {
					$("#unanswerd_body").append('<li class="text-left">' + value['question'] + '</li>');
				});
				//$("#submit").hide();
				var timer2 = "10:01";
				var interval = setInterval(function() {
					var timer = timer2.split(':');
					//by parsing integer, I avoid all extra string processing
					var minutes = parseInt(timer[0], 10);
					var seconds = parseInt(timer[1], 10);
					--seconds;
					minutes = (seconds < 0) ? --minutes : minutes;
					if (minutes < 0) clearInterval(interval);
					seconds = (seconds < 0) ? 59 : seconds;
					seconds = (seconds < 10) ? '0' + seconds : seconds;
					//minutes = (minutes < 10) ?  minutes : minutes;
					$('.countdown').html(minutes + ':' + seconds);
					if (minutes == 0 && seconds == 0) {
						alert("Time Out !");
						submit(saved_answers);
					}
					timer2 = minutes + ':' + seconds;
				}, 1000);
			});
		</script>
	</div>
</main>