<?php namespace App\Http\Controllers;

use Kint;
use Turk50;

class MechanicalTurkController extends Controller
{
    function index()
    {
        $AWSAccessKeyId = "AKIAIQQN5OPVJ2RK5HAQ";
        $AWSSecretAccessKeyId = "QP+LrdU8BRnzTGiAeniH/d4HArtM62nBgrrUzwx4";
        $turk50 = new Turk50($AWSAccessKeyId, $AWSSecretAccessKeyId, ["sandbox" => true]);

        $Question =
            "<QuestionForm xmlns='http://mechanicalturk.amazonaws.com/AWSMechanicalTurkDataSchemas/2005-10-01/QuestionForm.xsd'>" .
            "   <Overview>" .
            "       <Title>Overview of the Question Form</Title>" .
            "   </Overview>" .
            "   <Question>" .
            "       <QuestionIdentifier>identifier1</QuestionIdentifier>" .
            "       <DisplayName>Question 1</DisplayName>" .
            "       <QuestionContent>" .
            "           <Text>Here is the description of the question.</Text>" .
            "       </QuestionContent>" .
            "       <AnswerSpecification>" .
            "           <FreeTextAnswer></FreeTextAnswer>" .
            "       </AnswerSpecification>" .
            "   </Question>" .
            "</QuestionForm>";

        // prepare Request
        $Request = [
            "Operation"                   => "CreateHIT",
            "Title"                       => "a Title of the day 2 (pb)",
            "Description"                 => "Description of the day 2 (pb)",
            //"HITTypeId"                 => "32CVJ4DS81OX6T6Z7CO9WL1QJU3KVB",
            "Question"                    => $Question,
            "Reward"                      => ["Amount" => "0.01", "CurrencyCode" => "USD"],
            "AssignmentDurationInSeconds" => "3600", // 1 hour
            "LifetimeInSeconds"           => "259200", // 3 days
            //"QualificationRequirement"    => $QualificationRequirement
        ];

        // invoke CreateHIT
//        $CreateHITResponse = $turk50->CreateHIT($Request);
//        Kint::dump($CreateHITResponse);


        $getHitRequest = [
            //"HITId"     => $CreateHITResponse->HIT->HITId
            "HITId" => "3Y7LTZE0YTG8SI828VBX3YVR6YPZUW"
        ];
        $hit = $turk50->GetHIT($getHitRequest);
        s($hit);
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
