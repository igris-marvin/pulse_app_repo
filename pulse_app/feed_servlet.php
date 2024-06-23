<?php

require_once("connect.php");
require_once("feed_persistence.php");

if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    header("Location: /pulse_app/index.php");
    exit();
}


$pulse = getBpm($user_id, $conn);
$advice = '';
$mood = '';

if ($pulse >= 80) {
    $mood = "Happy";
    $advice = "• <b >Enjoy the Moment:</b><br> Happiness-induced elevated heart rates are generally positive, so take time to enjoy and savor the moment.
        • <b>Stay Hydrated:</b><br> Drink plenty of water to stay hydrated, which can help maintain a healthy heart rate.
        • <b>Practice Deep Breathing:</b><br> Engage in deep breathing exercises to help regulate your heart rate and promote relaxation.
        • <b>Engage in Light Physical Activity:</b><br> If you feel too excited, light physical activity like walking can help balance your energy levels.
        • <b>Monitor Your Heart Rate:</b><br> Keep an eye on your heart rate to ensure it returns to normal levels after the excitement subsides.
        • <b>Avoid Overstimulation:</b><br> While it's great to be happy, avoid overstimulating activities that might further elevate your heart rate excessively.
        • <b>Listen to Your Body:</b><br> Pay attention to how you feel and if you experience any discomfort, take a moment to rest and calm down.
        • <b>Consult with a Doctor:</b><br> If you have any underlying health conditions or if the elevated heart rate persists, consider consulting a healthcare professional for personalized advice.";
} elseif ($pulse >= 60 && $pulse < 80) {
    $mood = "Moderate";
    $advice = "• <b>Maintain a Healthy Lifestyle:</b><br> Continue engaging in regular physical activity, eating a balanced diet, and getting enough sleep to support overall heart health.
        • <b>Practice Mindfulness:</b><br> Engage in mindfulness or meditation practices to enjoy and enhance your sense of happiness while maintaining a stable heart rate.
        • <b>Stay Hydrated:</b><br> Keep yourself well-hydrated by drinking plenty of water throughout the day.
        • <b>Enjoy the Moment:</b><br> Take time to fully experience and appreciate the positive emotions you are feeling.
        • <b>Monitor Heart Rate Regularly:</b><br> Use a fitness tracker or heart rate monitor to keep track of your heart rate patterns and ensure they remain within a healthy range.
        • <b>Relaxation Techniques:</b><br> Incorporate relaxation techniques such as deep breathing exercises, yoga, or gentle stretching into your routine to maintain a calm and steady heart rate.
        • <b>Social Connections:</b><br> Spend time with loved ones and engage in activities that bring you joy and happiness, contributing to emotional well-being and a stable heart rate.
        • <b>Avoid Excessive Stress:</b><br> While feeling happy, be mindful of avoiding stressors that could negatively impact your heart rate and overall well-being.
        • <b>Regular Check-ups:</b><br> Ensure you have regular health check-ups with your healthcare provider to monitor your heart health and overall well-being.";
} else {
    $mood = "Sad";
    $advice = "• <b>Practice Self-Care:</b><br> Engage in activities that promote relaxation and self-care, such as taking a warm bath, reading a book, or spending time in nature.
        • <b>Deep Breathing Exercises:</b><br> Practice deep breathing exercises to help calm your mind and regulate your heart rate.
        • <b>Talk to Someone:</b><br> Reach out to friends, family, or a mental health professional to talk about your feelings. Sharing your emotions can help reduce stress and stabilize your heart rate.
        • <b>Mindfulness and Meditation:</b><br> Engage in mindfulness or meditation practices to help manage emotions and maintain a stable heart rate.
        • <b>Stay Hydrated:</b><br> Drink plenty of water to keep your body well-hydrated, which can help maintain a steady heart rate.
        • <b>Gentle Physical Activity:</b><br> Engage in gentle physical activities like walking or yoga to help release endorphins and improve your mood.
        • <b>Healthy Diet:</b><br> Eat a balanced diet rich in fruits, vegetables, and whole grains to support overall health and emotional well-being.
        • <b>Limit Stimulants:</b><br> Avoid excessive caffeine or nicotine, which can increase heart rate and exacerbate feelings of sadness or anxiety.
        • <b>Adequate Sleep:</b><br> Ensure you get enough rest and maintain a regular sleep schedule to support emotional health and heart rate stability.
        • <b>Professional Help:</b><br> If feelings of sadness persist or become overwhelming, consider seeking help from a mental health professional for additional support and guidance.";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulse App Advice</title>
    <style>
        b{
            font-size: 20px; /* Adjust this value as needed */
            line-height:50px;
        }
        
    </style>
</head>

</html>