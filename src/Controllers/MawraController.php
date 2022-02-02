<?php

namespace edgewizz\mawra\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Media;
use Edgewizz\Edgecontent\Models\ProblemSetQues;
use Edgewizz\Mawra\Models\MawraAns;
use Edgewizz\Mawra\Models\MawraQues;
use Illuminate\Http\Request;

class MawraController extends Controller
{
    public function store(Request $request){
        $mofQ = new MawraQues();
        $mofQ->question = $request->question;
        $mofQ->format_title = $request->format_title;
        $mofQ->difficulty_level_id = $request->difficulty_level_id;
        if($request->audio){
            $audio_name = time().$request->audio->getClientOriginalName();
            $audio_name = strtolower(str_replace(' ', '_', $audio_name));
            $audio = new Media();
            $request->audio->storeAs('public/answers', $audio_name);
            $audio->url = 'answers/'.$audio_name;
            $audio->save();
            $mofQ->media_id = $audio->id;
        }
        if($request->audio_es){
            $audio_name_es = time().$request->audio_es->getClientOriginalName();
            $audio_name_es = strtolower(str_replace(' ', '_', $audio_name_es));
            $audio = new Media();
            $request->audio_es->storeAs('public/answers', $audio_name_es);
            $audio->url = 'answers/'.$audio_name_es;
            $audio->save();
            $mofQ->media_id_es = $audio->id;
        }
        $mofQ->hint = $request->hint;
        $mofQ->save();
        /* answer1 */
        if($request->answer1){
            $ans1 = new MawraAns();
            $ans1->question_id = $mofQ->id;
            $ans1->answer = $request->answer1;
            $ans1->arrange = $request->arrange1;
            $ans1->eng_word = $request->eng_word1;
            $ans1->save();
        }
        /* answer1 */
        /* answer2 */
        if($request->answer2){
            $ans2 = new MawraAns();
            $ans2->question_id = $mofQ->id;
            $ans2->answer = $request->answer2;
            $ans2->arrange = $request->arrange2;
            $ans2->eng_word = $request->eng_word2;
            $ans2->save();
        }
        /* answer2 */
        /* answer3 */
        if($request->answer3){
            $ans3 = new MawraAns();
            $ans3->question_id = $mofQ->id;
            $ans3->answer = $request->answer3;
            $ans3->arrange = $request->arrange3;
            $ans3->eng_word = $request->eng_word3;
            $ans3->save();
        }
        /* answer3 */
        /* answer4 */
        if($request->answer4){
            $ans4 = new MawraAns();
            $ans4->question_id = $mofQ->id;
            $ans4->answer = $request->answer4;
            $ans4->arrange = $request->arrange4;
            $ans4->eng_word = $request->eng_word4;
            $ans4->save();
        }
        /* answer4 */
        /* answer5 */
        if($request->answer5){
            $ans5 = new MawraAns();
            $ans5->question_id = $mofQ->id;
            $ans5->answer = $request->answer5;
            $ans5->arrange = $request->arrange5;
            $ans5->eng_word = $request->eng_word5;
            $ans5->save();
        }
        /* answer5 */
        /* answer6 */
        if($request->answer6){
            $ans6 = new MawraAns();
            $ans6->question_id = $mofQ->id;
            $ans6->answer = $request->answer6;
            $ans6->arrange = $request->arrange6;
            $ans6->eng_word = $request->eng_word6;
            $ans6->save();
        }
        /* answer6 */
        if($request->problem_set_id && $request->format_type_id){
            $pbq = new ProblemSetQues();
            $pbq->problem_set_id = $request->problem_set_id;
            $pbq->question_id = $mofQ->id;
            $pbq->format_type_id = $request->format_type_id;
            $pbq->save();
        }
        return back();
    }


    public function update($id, Request $request){
        $q = MawraQues::where('id', $id)->first();
        $q->question = $request->question;
        $q->difficulty_level_id = $request->difficulty_level_id;
        if($request->format_title){
            $q->format_title = $request->format_title;
        }
        if($request->audio){
            $audio_name = time().$request->audio->getClientOriginalName();
            $audio_name = strtolower(str_replace(' ', '_', $audio_name));
            $audio = new Media();
            $request->audio->storeAs('public/answers', $audio_name);
            $audio->url = 'answers/'.$audio_name;
            $audio->save();
            $q->media_id = $audio->id;
        }
        if($request->audio_es){
            $audio_name_es = time().$request->audio_es->getClientOriginalName();
            $audio_name_es = strtolower(str_replace(' ', '_', $audio_name_es));
            $audio = new Media();
            $request->audio_es->storeAs('public/answers', $audio_name_es);
            $audio->url = 'answers/'.$audio_name_es;
            $audio->save();
            $q->media_id_es = $audio->id;
        }
        $q->hint = $request->hint;
        // $q->level = $request->question_level;
        // $q->score = $request->question_score;
        // $q->hint = $request->question_hint;
        $q->save();
        $answers = MawraAns::where('question_id', $q->id)->get();
        foreach($answers as $ans){
            if($request->ans.$ans->id){
                $inputAnswer = 'answer'.$ans->id;
                $inputArrange = 'arrange'.$ans->id;
                $inputEngWord = 'eng_word'.$ans->id;
                $ans->answer = $request->$inputAnswer;
                $ans->arrange = $request->$inputArrange;
                $ans->eng_word = $request->$inputEngWord;
                $ans->save();
            }
        }
        if($request->new1){
            $new_q_1 = new MawraAns();
            $new_q_1->question_id = $q->id;
            $new_q_1->answer = $request->new1;
            $new_q_1->arrange = $request->new_arrange_1;
            $new_q_1->save();
        }
        if($request->new2){
            $new_q_1 = new MawraAns();
            $new_q_1->question_id = $q->id;
            $new_q_1->answer = $request->new2;
            $new_q_1->arrange = $request->new_arrange_2;
            $new_q_1->save();
        }
        return back();
    }

    public function imagecsv($question_image, $images){
        foreach($images as $valueImage){
            $uploadImage = explode(".", $valueImage->getClientOriginalName());
            if($uploadImage[0] == $question_image){
                // dd($valueImage);
                $audio_name = time().uniqid().$valueImage->getClientOriginalName();
                $audio_name = strtolower(str_replace(' ', '_', $audio_name));
                $media = new Media();
                $valueImage->storeAs('public/question_images', $audio_name);
                $media->url = 'question_images/' . $audio_name;
                $media->save();
                return $media->id;
            }
        }
    }

    public function csv_upload(Request $request){
        
        $file = $request->file('file');
        $audio = $request->file('audio');
        $audio_es = $request->file('audio_es');
        // dd($file);
        // File Details
        $filename = time().$file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();
        // Valid File Extensions
        $valid_extension = array("csv");
        // 2MB in Bytes
        $maxFileSize = 2097152;
        // Check file extension
        if (in_array(strtolower($extension), $valid_extension)) {
            // Check file size
            if ($fileSize <= $maxFileSize) {
                // File upload location
                $location = 'uploads';
                // Upload file
                $file->move($location, $filename);
                // Import CSV to Database
                $filepath = public_path($location . "/" . $filename);
                // Reading file
                $file = fopen($filepath, "r");
                $importData_arr = array();
                $i = 0;
                while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
                    $num = count($filedata);
                    // Skip first row (Remove below comment if you want to skip the first row)
                    if($i == 0){
                        $i++;
                        continue;
                    }
                    for ($c = 0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata[$c];
                    }
                    $i++;
                }
                fclose($file);
                // Insert to MySQL database
                foreach ($importData_arr as $importData) {
                    $insertData = array(
                            "question"      => $importData[1],
                            "answer_1"      => $importData[2],
                            "engword_1"     => $importData[3],
                            "arrange_1"     => $importData[4],
                            "answer_2"      => $importData[5],
                            "engword_2"     => $importData[6],
                            "arrange_2"     => $importData[7],
                            "answer_3"      => $importData[8],
                            "engword_3"     => $importData[9],
                            "arrange_3"     => $importData[10],
                            "answer_4"      => $importData[11],
                            "engword_4"     => $importData[12],
                            "arrange_4"     => $importData[13],
                            "answer_5"      => $importData[14],
                            "engword_5"     => $importData[15],
                            "arrange_5"     => $importData[16],
                            "answer_6"      => $importData[17],
                            "engword_6"     => $importData[18],
                            "arrange_6"     => $importData[19],
                            "level"         => $importData[20],
                            "hint"          => $importData[21],
                            "audio"         => $importData[22],
                            "audio_es"      => $importData[23],
                        );
                        // var_dump($insertData['answer1']); 
                        /*  */
                        if($insertData['question']){
                            $fill_Q = new MawraQues();
                            $fill_Q->question = $insertData['question'];
                            $fill_Q->format_title = $request->format_title;
                            if(!empty($insertData['level'])){
                                if($insertData['level'] == 'easy'){
                                    $fill_Q->difficulty_level_id = 1;
                                }else if($insertData['level'] == 'medium'){
                                    $fill_Q->difficulty_level_id = 2;
                                }else if($insertData['level'] == 'hard'){
                                    $fill_Q->difficulty_level_id = 3;
                                }
                            }
                            if (!empty($insertData['audio']) && $insertData['audio'] != '') {
                                $media_id = $this->imagecsv($insertData['audio'], $audio);
                                $fill_Q->media_id = $media_id;
                            }
                            if (!empty($insertData['audio_es']) && $insertData['audio_es'] != '') {
                                $media_id_es = $this->imagecsv($insertData['audio_es'], $audio_es);
                                $fill_Q->media_id_es = $media_id_es;
                            }
                            if($insertData['hint'] == '-'){
                            }else{
                                $fill_Q->hint = $insertData['hint'];
                            }
                            $fill_Q->save();

                            if($request->problem_set_id && $request->format_type_id){
                                $pbq = new ProblemSetQues();
                                $pbq->problem_set_id        = $request->problem_set_id;
                                $pbq->question_id           = $fill_Q->id;
                                $pbq->format_type_id        = $request->format_type_id;
                                $pbq->save();
                            }
                            
                            for($i = 1; $i <= 6; $i++){
                                if($insertData['answer_'.$i] == '-'){
                                }else{
                                    $f_Ans1                 = new MawraAns();
                                    $f_Ans1->question_id    = $fill_Q->id;
                                    $f_Ans1->answer         = $insertData['answer_'.$i];
                                    $f_Ans1->eng_word       = $insertData['engword_'.$i];
                                    $f_Ans1->arrange        = $insertData['arrange_'.$i];
                                    $f_Ans1->save();
                                }
                            }

                        }
                        /*  */
                    }
                // Session::flash('message', 'Import Successful.');
            } else {
                // Session::flash('message', 'File too large. File must be less than 2MB.');
            }
        } else {
            // Session::flash('message', 'Invalid File Extension.');
        }
    return back();
}

    public function inactive($id){
        $f = MawraQues::where('id', $id)->first();
        $f->active = '0';
        $f->save();
        return back();
    }
    public function active($id){
        $f = MawraQues::where('id', $id)->first();
        $f->active = '1';
        $f->save();
        return back();
    }
}
   