<?php
    namespace App;
    class FuzzyElectre 
    {
        private $dataA = array(); 
        private $dataB = array(); 

        /**
         * constructor
         *  initiate data by assign performanceRating and criteria to array
         *PARAM
         *  $performanceRating = array of performanceRating
         *  $linguistic = array of linguistic variable of criterias
         * 
         *  STEP 1 DETERMINE EVALUATION CRITERIA
         *  STEP 2 DETERMINE PERFORMANCE RATING
         *  STEP 3 GET WEIGHT OF CRITERIA IN LINGUISTIC VARIABLE
         */
        function __construct($performanceRating, $criteriaWeight)
        {            
            //assign criteria of each alternative to 2 dimension array
            foreach ($performanceRating as $key => $value) {
                //each row describes 1 alternative
                $dataA[$key][0]= $performanceRating[$key]['perf_rating_harga'];
                $dataA[$key][1]= $performanceRating[$key]['perf_rating_kayu_body'];
            }
            

            //assign criteria weight variable of each criteria to an array
            foreach ($criteriaWeight as $key => $value) {    
                $dataB[$key]= $criteriaWeight[$key];
            }               
            
            $fuzzyDecisionMatrix = $this->fuzzyDecicionMatrix($dataA, $dataB);
            
            $normalizedFuzzyDecisionMatrix = $this->normalizedFuzzyDesicionMatrix($fuzzyDecisionMatrix,$dataA, $dataB);
            $weightedNormalizedFuzzyDecisionMatrix = $this->weightedNormalizedFuzzyDecisionMatrix($normalizedFuzzyDecisionMatrix, $criteriaWeight);
        }

        /**tfnRating
         *  converts linguistic variable for performance rating of alternative
         *  to triangular fuzzy number
         *PARAM
         *  $linguistic = linguistic variable of performance rating : STRING
         *RETURNS
         *  $value = triangular fuzzy number : array[float]
         * 
         * STEP 5 CONVERT PERFORMANCE RATING LINGUISTIC ASSESMENT TO TRIANGULAR FUZZY NUMBER
         */
        function tfnRating ($linguistic)
        {   
            switch ($linguistic) {
                case 'very poor':
                    $value = [0.0, 0.0, 2.5];
                    return $value;
                    break;
                
                case 'poor':
                    $value = [0.0, 2.5, 5.0];
                    return $value;
                    break;

                case 'fair':
                    $value = [2.5, 5.0, 7.5];
                    return $value;
                    break;
                
                case 'good':
                    $value = [5.0, 7.5, 10.0];
                    return $value;
                    break;
                
                case 'very good':
                    $value = [7.5, 10.0, 10.0];
                    return $value;
                    break;
            }
        }

        /**tfnCriteria
         *  converts linguistic variable for criterion to triangular fuzzy number
         *PARAM
         *  $linguistic = linguistic variable of criterion : STRING
         *RETURNS
         *  $value = triangular fuzzy number : array[float]
         * 
         * STEP 4 CONVERT WEIGHT OF CRITERIA LINGUISTIC ASSESMENT TO TRIANGULAR FUZZY NUMBER
         */
        function tfnCriteria ($linguistic)
        {   
            switch ($linguistic) {
                case 'very low':
                    $value = [0.0, 0.0, 0.25];
                    return $value;
                    break;
                
                case 'low':
                    $value = [0.0, 0.25, 0.50];
                    return $value;
                    break;

                case 'medium':
                    $value = [0.25, 0.50, 0.75];
                    return $value;
                    break;
                
                case 'high':
                    $value = [0.50, 0.75, 1.0];
                    return $value;
                    break;
                
                case 'very high':
                    $value = [0.75, 1.0, 1.0];
                    return $value;
                    break;
            }
        }

        /** fuzzyDecisionMatrix
         *  converts performance rating to triangular fuzzy number-
         *  -and shape them to fuzzy decision matrix
         *PARAM
         *  performanceRating = performance rating of criteria : array[][] string
         *  criteriaWeight = linguistic assesment of criteria's weight : array[string]
         *RETURNS
         *  fuzzyDecisionMatrix : array
         * 
         * STEP 6 CALCULATE FUZZY DECISION MATRIX 
         */
        function fuzzyDecicionMatrix ($performanceRating, $criteriaWeight)
        {   
            $fuzzyDecisionMatrix = array();
            //get fuzzy weight of criteria in tfn
            for ($i=0; $i < count($performanceRating); $i++) { 
                for ($j=0; $j < count($criteriaWeight); $j++) {     
                    $fuzzyDecisionMatrix[$i][$j] = $this->tfnRating($performanceRating[$i][$j]);
                }
            }
            return $fuzzyDecisionMatrix;
        }

        /**normalizedFuzzyDesicionMatrix
         * form normalized fuzzy decision matrix
         *PARAM
         *  fuzzyDecisionMatrix = unnormalized fuzzy decision matrix : array[][][]
         *  performanceRating = performance rating of criteria : array[][] string
         *  criteriaWeight = linguistic assesment of criteria's weight : array[string]
         *RETURN
         *  normalizedFuzzyDecisionMatrix : array[float]
         * 
         *STEP 7 FORM NORMALIZED FUZZY DECISION MATRIX
         */
        function normalizedFuzzyDesicionMatrix($fuzzyDecisionMatrix ,$performanceRating, $criteriaWeight)
        {
            //convert performance rating to tfn
            $rating = array();
            for ($i=0; $i < count($performanceRating); $i++) { 
                for ($j=0; $j < count($criteriaWeight); $j++) {     
                    $rating[$i][$j] = $this->tfnRating($performanceRating[$i][$j]);
                }
            }
            
            //get highest tfn
            $maxTFN = array([0,0,0],[0,0,0]);
            foreach ($criteriaWeight as $key => $value) {
                foreach ($rating as $tfnRating) {
                    if ($tfnRating[0] > $maxTFN) {
                        $maxTFN[$key] = $tfnRating[0];
                    }
                }
            }
            
            //get highest element in tfn
            $maxFuzzyComponent = array();
            foreach ($maxTFN as $key => $value) {
                $maxFuzzyComponent[$key] = max($maxTFN[$key]);
            }

            //divide each fuzzy component in fuzzyDecisionMatrix with maxFuzzyComponent-
            //-for respective criteria
            $normalizedFuzzyDecisionMatrix = array();
            for ($criteria=0; $criteria < count($maxFuzzyComponent); $criteria++) { 
                foreach ($fuzzyDecisionMatrix as $keyAlternative => $alternative) {
                    foreach ($alternative[$criteria] as $key => $value) {
                        $normalizedFuzzyDecisionMatrix[$keyAlternative][$criteria][$key] = $fuzzyDecisionMatrix[$keyAlternative][$criteria][$key] / $maxFuzzyComponent[$criteria];
                    }
                }
            }
            
            return $normalizedFuzzyDecisionMatrix;
        }

        /**weightedNormalizedFuzzyDecisionMatrix
         * form weighted normalized fuzzy decision matrix
         *PARAM
         * normalizedFuzzyDecisionMatrix = normalized fuzzy decision matrix : array[][][] float
         * criteriaWeight = linguistic assesment of criteria's weight : array[] string
         *RETURNS
         * weightedNormalizedFuzzyDecisionMatrix = weighted normalize fuzzy decision matrix : array[][][] float
         */
        function weightedNormalizedFuzzyDecisionMatrix($normalizedFuzzyDecisionMatrix, $criteriaWeight)
        {
            $weightedNormalizedFuzzyDecisionMatrix = array();
            
            //convert criteriaweight to tfn
            foreach ($criteriaWeight as $key => $value) {
                $criteriaWeight[$key] = $this->tfnCriteria($criteriaWeight[$key]);
            }

            for ($criteria=0; $criteria < count($criteriaWeight); $criteria++) { 
                foreach ($normalizedFuzzyDecisionMatrix as $keyAlternative => $alternative) {
                    foreach ($alternative[$criteria] as $key => $value) {
                        $weightedNormalizedFuzzyDecisionMatrix[$keyAlternative][$criteria][$key] = $normalizedFuzzyDecisionMatrix[$keyAlternative][$criteria][$key] * $criteriaWeight[$criteria][$key];
                    }
                }
            }
            return $weightedNormalizedFuzzyDecisionMatrix;
        }

        function hamming_distance ()
        {

        }

    }



?>