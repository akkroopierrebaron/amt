<?php namespace App\Http\Controllers;

use Kint;
use Turk50;

class MechanicalTurkController extends Controller
{
    function index()
    {
        //TODO I spotted an error when we want to send request at 12h00.
        // I tried at 12h38 and had an error about a problem in my timestamp
        // I guess the problem comes from a bad timezone.


        $AWSAccessKeyId = "AKIAIQQN5OPVJ2RK5HAQ";
        $AWSSecretAccessKeyId = "QP+LrdU8BRnzTGiAeniH/d4HArtM62nBgrrUzwx4";
        $turk50 = new Turk50($AWSAccessKeyId, $AWSSecretAccessKeyId, ["sandbox" => true]);

//        $Question =
//            "<QuestionForm xmlns='http://mechanicalturk.amazonaws.com/AWSMechanicalTurkDataSchemas/2005-10-01/QuestionForm.xsd'>" .
//            "   <Overview>" .
//            "       <Title>Overview of the Question Form</Title>" .
//            "   </Overview>" .
//            "   <Question>" .
//            "       <QuestionIdentifier>identifier1</QuestionIdentifier>" .
//            "       <DisplayName>Question 1</DisplayName>" .
//            "       <QuestionContent>" .
//            "           <Text>Here is the description of the question.</Text>" .
//            "       </QuestionContent>" .
//            "       <AnswerSpecification>" .
//            "           <FreeTextAnswer></FreeTextAnswer>" .
//            "       </AnswerSpecification>" .
//            "   </Question>" .
//            "</QuestionForm>";

        $Question =
            "<HTMLQuestion xmlns='http://mechanicalturk.amazonaws.com/AWSMechanicalTurkDataSchemas/2011-11-11/HTMLQuestion.xsd'>" .
            "   <HTMLContent><![CDATA[" .
            "<!DOCTYPE html><html><head> <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/> <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'> <script type='text/javascript' src='https://s3.amazonaws.com/mturk-public/externalHIT_v1.js'></script></head><body><div class='container'> <div class='panel panel-primary'> <div class='panel-heading'> <strong>Instructions</strong> </div><div class='panel-body'> <p>Type out the following pieces of text contained in the image of the business card.</p><ul> <li>Look at the photo of the business card</li><li>If the card is showing the wrong way up, tap each Rotate Image option in turn (<strong>A | B | C | D</strong>) until it is shown then correct way up. Click on the photograph to see a larger version of it (it&nbsp;will open in a new window). </li><li>Type out&nbsp;the&nbsp;<strong>company name</strong>&nbsp;if it&#39;s provided. Work it out from&nbsp;the logo or domain name if it&#39;s&nbsp;not&nbsp;written out. </li><li>Type out the <strong>full name as it appears on the card</strong> (do <strong>not</strong> include titles or suffixes&nbsp;e.g. Mr, Mrs, Prof, BSc, MBE.&nbsp;If you are very unsure, it&#39;s fineto&nbsp;include it.) </li><li>Type out the <strong>job title,&nbsp;first email address shown&nbsp;and&nbsp;first phone number shown</strong>&nbsp;into the boxes provided </li><li>Write out the <strong>website address&nbsp;</strong>if it is provided - do not type http:// or https:// </li><li>If any of these items&nbsp;are not present on the card, leave that box&nbsp;blank </li></ul> </div></div><div class='row'> <div class='col-sm-12'> <p> <b>Rotate Image Option:</b> <a href='#' id='rotate-left'>A</a> | <a href='#' id='rotate-reset'>B</a> | <a href='#' id='rotate-right'>C</a> | <a href='#' id='rotate-downside'>D</a> </p></div><div class='row'> <div class='col-sm-6'> <a href='http://media02.hongkiat.com/free-businesscard-templates/01-Front.jpg' target='_blank'> <img alt='image_url' id='image_url' class='img-responsive' src='http://media02.hongkiat.com/free-businesscard-templates/01-Front.jpg'/> </a> </div><div class='col-sm-6'> <form name='mturk_form' method='post' id='mturk_form' action='https://www.mturk.com/mturk/externalSubmit'> <input type='hidden' value='' name='assignmentId' id='assignmentId'/> <div class='form-group'> <label for='CompanyName'>Company Name:</label> <input class='form-control' name='CompanyName' size='30' id='CompanyName' type='text' value='${CompanyName}'/> </div><div class='form-group'> <label for='FullName'>Full Name: (e.g. James H Carswell)</label> <input class='form-control' name='FullName' size='30' id='FullName' type='text' value='${FullName}'/> </div><div class='form-group'> <label for='JobTitle'>Job Title:</label> <input class='form-control' name='JobTitle' size='30' id='JobTitle' type='text' value=''/> </div><div class='form-group'> <label for='EmailAddress'>Email Address (first shown):</label> <input class='form-control' name='EmailAddress' size='30' id='EmailAddress' type='email' value=''/> </div><div class='form-group'> <label for='PrimaryPhoneNumber'>Phone Number (first shown):</label> <input class='form-control' name='PrimaryPhoneNumber' size='30' id='PrimaryPhoneNumber' type='text' value=''/> </div><div class='form-group'> <label for='Website'>Website: (don&#39;t include http://)</label> <input class='form-control' name='Website' size='30' id='Website' type='text' value=''/> </div><div class='form-group'> <input type='submit' id='submitButton' value='Submit' class='btn btn-default'/> </div><script language='Javascript'>turkSetAssignmentID();</script> </form> </div></div></div></div></body></html>" .
            "]]></HTMLContent>" .
            "   <FrameHeight>600</FrameHeight>" .
            "</HTMLQuestion>";

        $AssignmentReviewPolicy =
            "<AssignmentReviewPolicy>" .
            "   <PolicyName>ScoreMyKnownAnswers/2011-09-01</PolicyName>" .
            "   <Parameter>" .
            "       <Key>AnswerKey</Key>" .
            "       <MapEntry>" .
            "           <Key>identifier1</Key>" .
            "           <Value>hello</Value>" .
            "       </MapEntry>" .
            "   </Parameter>" .
            "   <Parameter>" .
            "       <Key>ApproveIfKnownAnswerScoreIsAtLeast</Key>" .
            "       <Value>79</Value>" .
            "   </Parameter>" .
            "   <Parameter>" .
            "       <Key>ExtendIfKnownAnswerScoreIsLessThan</Key>" .
            "       <Value>79</Value>" .
            "   </Parameter>" .
            "   <Parameter>" .
            "       <Key>ExtendMaximumAssignments</Key>" .
            "       <Value>3</Value>" .
            "   </Parameter>" .
            "</AssignmentReviewPolicy>";

        $HITReviewPolicy =
            "<HITReviewPolicy>" .
            "   <PolicyName>SimplePlurality/2011-09-01</PolicyName>" .
            "   <Parameter>" .
            "       <Key>QuestionIDs</Key>" .
            "       <Value>identifier1</Value>" .
            "   </Parameter>" .
            "   <Parameter>" .
            "       <Key>QuestionAgreementThreshold</Key>" .
            "       <Value>100</Value>" .
            "   </Parameter>" .
            "</HITReviewPolicy>";

        // prepare Request
        $Request = [
            "Operation"                   => "CreateHIT",
            "Title"                       => "a Title of the day 7 (pb)",
            "Description"                 => "Description of the day 7 (pb)",
            "Question"                    => $Question,
            "Reward"                      => ["Amount" => "0.05", "CurrencyCode" => "USD"],
            "AssignmentDurationInSeconds" => "180",
            "LifetimeInSeconds"           => "259200",
            //"AssignmentReviewPolicy"      => $AssignmentReviewPolicy,
            //"HITReviewPolicy"             => $HITReviewPolicy,
            "RequesterAnnotation"         => "my-registration-id"
        ];

        // invoke CreateHIT
        $CreateHITResponse = $turk50->CreateHIT($Request);
        s($CreateHITResponse);


//        $getHitRequest = [
//            //"HITId"     => $CreateHITResponse->HIT->HITId
//            "HITId" => "3Y7LTZE0YTG8SI828VBX3YVR6YPZUW"
//        ];
//        $hit = $turk50->GetHIT($getHitRequest);
//        s($hit);
//
//        $hits = $turk50->GetReviewableHITs();
//        Kint::dump($hits);
//
//        foreach ($hits->GetReviewableHITsResult->HIT as $h) {
//            $getHitRequest = [
//                //"HITId"     => $CreateHITResponse->HIT->HITId
//                "HITId" => $h->HITId
//            ];
//            $hit = $turk50->GetHIT($getHitRequest);
//            Kint::dump($hit);
//        }
    }
}
