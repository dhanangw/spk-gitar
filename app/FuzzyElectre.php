<?php
    namespace App;
    class FuzzyElectre 
    {
        private $dataA = array(); 
        private $dataB = array(); 
        public $ranking;
        public $fuzzyDecisionMatrix;
        public $normalizedFuzzyDecisionMatrix;
        public $weightedNormalizedFuzzyDecisionMatrix;
        public $concordanceMatrix;
        public $concordanceLevel;
        public $discordanceMatrix;
        public $discordanceLevel;
        public $matrixBooleanB;
        public $matrixBooleanH;
        public $matriksGlobalZ;

        /**constructor
         * initiate data by assign performanceRating and criteria to array
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
            file_put_contents('fuzzyDecisionMatrix.txt',print_r($fuzzyDecisionMatrix, true) , FILE_APPEND);
            $normalizedFuzzyDecisionMatrix = $this->normalizedFuzzyDesicionMatrix($fuzzyDecisionMatrix,$dataA, $dataB);
            file_put_contents('normalizedFuzzyDecisionMatrix.txt',print_r($normalizedFuzzyDecisionMatrix, true) , FILE_APPEND);
            $weightedNormalizedFuzzyDecisionMatrix = $this->weightedNormalizedFuzzyDecisionMatrix($normalizedFuzzyDecisionMatrix, $criteriaWeight);
            file_put_contents('weightedNormalizedFuzzyDecisionMatrix.txt',print_r($weightedNormalizedFuzzyDecisionMatrix, true) , FILE_APPEND);
            $concordanceMatrix = $this->concordanceMatrix($weightedNormalizedFuzzyDecisionMatrix, $dataA, $dataB);
            file_put_contents('concordanceMatrix.txt',print_r($concordanceMatrix, true) , FILE_APPEND);
            $concordanceLevel = $this->concordanceLevel($concordanceMatrix);
            file_put_contents('concordanceLevel.txt',print_r($concordanceLevel, true) , FILE_APPEND);
            $discordanceMatrix = $this->discordanceMatrix($weightedNormalizedFuzzyDecisionMatrix, $dataA, $dataB);
            file_put_contents('discordanceMatrix.txt',print_r($discordanceMatrix, true) , FILE_APPEND);
            $discordanceLevel = $this->discordanceLevel($discordanceMatrix);
            file_put_contents('discordanceLevel.txt',print_r($discordanceLevel, true) , FILE_APPEND);
            $matrixBooleanB = $this->matrixBooleanB($concordanceMatrix, $concordanceLevel);
            file_put_contents('matrixBooleanB.txt',print_r($matrixBooleanB, true) , FILE_APPEND);
            $matrixBooleanH = $this->matrixBooleanH($discordanceMatrix, $discordanceLevel);
            file_put_contents('matrixBooleanH.txt',print_r($matrixBooleanH, true) , FILE_APPEND);
            $matriksGlobalZ = $this->matrixGlobalZ($matrixBooleanB, $matrixBooleanH);
            file_put_contents('matriksGlobalZ.txt',print_r($matriksGlobalZ, true) , FILE_APPEND);
            $this->ranking = $this->getRanking($matriksGlobalZ);
            file_put_contents('ranking.txt',print_r($this->ranking, true) , FILE_APPEND);
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
                case "very poor":
                    $value = [0.0, 0.0, 2.5];
                    return $value;
                    break;
                
                case "poor":
                    $value = [0.0, 2.5, 5.0];
                    return $value;
                    break;

                case "fair":
                    $value = [2.5, 5.0, 7.5];
                    return $value;
                    break;
                
                case "good":
                    $value = [5.0, 7.5, 10.0];
                    return $value;
                    break;
                
                case "very good":
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
                case "very low":
                    $value = [0.0, 0.0, 0.25];
                    return $value;
                    break;
                
                case "low":
                    $value = [0.0, 0.25, 0.50];
                    return $value;
                    break;

                case "medium":
                    $value = [0.25, 0.50, 0.75];
                    return $value;
                    break;
                
                case "high":
                    $value = [0.50, 0.75, 1.0];
                    return $value;
                    break;
                
                case "very high":
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
            
            //get highest element in highest tfn
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
         * 
         * STEP 8 FORM WEIGHTED NORMALIZED FUZZY DECISION MATRIX
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

        /**hammingDistance
         * calculate hamming distance between 2 criteria (only works for triangular fuzzy)
         *PARAM
         * $alternative1 = a component of weighted fuzzy decision matrix that corresponds to 1 alternative
         * $alternative2 = a component of weighted fuzzy decision matrix that corresponds to 1 alternative
         *RETURNS
         * array[] 
         *  $kiri = value hamming distance array on left side : float
         *  $kanan = value hamming distance array on right side : float
         *  $oo = determines whether the distance is 0 : string
         *  $concordanceSet = determines whether the hamming distance array belongs to concordance set : string
         *  $discordanceSet = determines whether the hamming distance array belongs to discordance set : string
         * 
         * STEP 9 CALCULATE THE HAMMING DISTANCE
         */
        function hammingDistance ($alternative1, $alternative2)
        {
            if (($alternative1[0] <= $alternative2[0]) && ($alternative1[1] <= $alternative2[1]) && ($alternative1[2] <= $alternative2[2])) {
                if (($alternative1[0] == $alternative2[0]) && ($alternative1[1] == $alternative2[1]) && ($alternative1[2] == $alternative2[2])) {
                    //if 0-0 -> kiri and kanan value = 0
                    $kanan = 0;
                    $kiri = 0;
                    $oo = "yes";
                    $concordanceSet = "no";
                    $discordanceSet = "no";
                } else {
                    $kiri = abs(abs($alternative1[2]-$alternative2[0])*abs($alternative1[2]-$alternative2[0])/abs($alternative2[1]-$alternative2[0]+$alternative1[2]-$alternative1[1]))/2;
                    $kanan = 0;
                    $oo = "no";
                    $concordanceSet = "no";
                    $discordanceSet = "yes";
                }
            }
            // check each criteria whether it belongs to concordance set, discordance set or 0-0
            if (($alternative1[0] >= $alternative2[0]) && ($alternative1[1] >= $alternative2[1]) && ($alternative1[2] >= $alternative2[2])) {
                if (($alternative1[0] == $alternative2[0]) && ($alternative1[1] == $alternative2[1]) && ($alternative1[2] == $alternative2[2])) {
                    //if 0-0 -> kiri and kanan value = 0
                    $kanan = 0;
                    $kiri = 0;
                    $oo = "yes";
                    $concordanceSet = "no";
                    $discordanceSet = "no";
                } else {
                    //  if concordance set -> value kiri dihitung pakai rumus, value kanan = 0
                    $kiri = 0;
                    $kanan =  abs(abs($alternative1[2]-$alternative2[0])*abs($alternative1[2]-$alternative2[0])/abs($alternative2[1]-$alternative2[0]+$alternative1[2]-$alternative1[1]))/2;
                    $oo = "no";
                    $concordanceSet = "yes";
                    $discordanceSet = "no";
                }
            }

            return(array('kiri' => $kiri, 'kanan' => $kanan, 'concordanceSet' => $concordanceSet, 'discordanceSet' => $discordanceSet, 'oo' => $oo));      
        }

        /**concordanceMatrix
         * form concordance matrix (only works for triangular fuzzy and 2 criterias)
         *PARAM
         * $weightedNormalizedFuzzyDecisionMatrix = weighted normalized fuzzy decision matrix
         * $alternative = all alternative considered
         * $criteriaWeight = linguistic assesment of alternative in a criteria
         *RETURNS
         * $concordanceMatrix = concordance matrix
         * 
         * STEP 10 FORM THE CONCORDANCE MATRIX
         */
        function concordanceMatrix($weightedNormalizedFuzzyDecisionMatrix, $alternative, $criteriaWeight)
        {
            $concordanceMatrix = array();
            $hamming1 = array();
            $hamming2 = array();

            //get TFN criteria
            foreach ($criteriaWeight as $key => $value) {
                $criteriaWeight[$key] = $this->tfnCriteria($value);
            }
            
            //calculate hamming distance of alternatives in all criteria
            foreach ($alternative as $keyAlternative => $valueAlternative) {
                for ($i=0; $i < count($alternative); $i++) { 
                    if ($i <= $keyAlternative) {
                        $hamming1[$keyAlternative][$i] = ["-"];
                        $hamming2[$keyAlternative][$i] = ["-"];
                    } else {
                        $hamming1[$keyAlternative][$i] = $this->hammingDistance($weightedNormalizedFuzzyDecisionMatrix[$keyAlternative][0], $weightedNormalizedFuzzyDecisionMatrix[$i][0]);
                        $hamming2[$keyAlternative][$i] = $this->hammingDistance($weightedNormalizedFuzzyDecisionMatrix[$keyAlternative][1], $weightedNormalizedFuzzyDecisionMatrix[$i][1]);
                    }
                }
            }
            
            //form the concordance matrix
            foreach ($alternative as $keyAlternative => $value) {
                for ($i=0; $i < count($alternative); $i++) {
                    if ($i == $keyAlternative) { //alternatives are same
                        $concordanceMatrix[$keyAlternative][$i] = ["-","-","-"];
                    }  else {
                        $tempConcordance = array(0,0,0);
                        //get which criteria(s) that are in the concordance set
                        if ( implode($hamming1[$keyAlternative][$i])  !== "-" && implode($hamming2[$keyAlternative][$i] ) !== "-" ) {
                            if ($hamming1[$keyAlternative][$i]['concordanceSet'] === "yes" || $hamming1[$keyAlternative][$i]['oo'] === "yes") {
                                $tempConcordance = array($tempConcordance[0] + $criteriaWeight[0][0], $tempConcordance[1] + $criteriaWeight[0][1], $tempConcordance[2] + $criteriaWeight[0][2]);   
                            }
                            if ($hamming2[$keyAlternative][$i]['concordanceSet'] === "yes" || $hamming2[$keyAlternative][$i]['oo'] === "yes") {
                                $tempConcordance = array($tempConcordance[0] + $criteriaWeight[1][0], $tempConcordance[1] + $criteriaWeight[1][1], $tempConcordance[2] + $criteriaWeight[1][2]);   
                            }
                        } else {
                            if ($hamming1[$i][$keyAlternative]['concordanceSet'] === "no")  {
                                $tempConcordance = [$tempConcordance[0] + $criteriaWeight[0][0], $tempConcordance[1] + $criteriaWeight[0][1], $tempConcordance[2] + $criteriaWeight[0][2] ];
                            }
                            if ($hamming2[$i][$keyAlternative]['concordanceSet'] === "no") {
                                $tempConcordance = [$tempConcordance[0] + $criteriaWeight[1][0], $tempConcordance[1] + $criteriaWeight[1][1], $tempConcordance[2] + $criteriaWeight[1][2] ];
                            }
                        }
                        $concordanceMatrix[$keyAlternative][$i] = $tempConcordance;
                    }
                }
            }
            return $concordanceMatrix ;
        }

        /**discordanceMatrix
         * form the discordance matrix
         *PARAMS
         * $weightedNormalizedFuzzyDecisionMatrix = weighted normalized fuzzy decision matrix
         * $alternative = all alternative considered
         * $criteriaWeight = linguistic assesment of alternative in a criteria
         *RETURNS
         * $discordanceMatrix = discordance matrix
         * 
         * STEP 11 FORM THE DISCORDANCE MATRIX
         */
        function discordanceMatrix($weightedNormalizedFuzzyDecisionMatrix, $alternative, $criteriaWeight)
        {
            $discordanceMatrix = array();
            $hamming1 = array();
            $hamming2 = array();

            //get TFN criteria
            foreach ($criteriaWeight as $key => $value) {
                $criteriaWeight[$key] = $this->tfnCriteria($value);
            }
        
            //calculate hamming distance of alternatives in all criteria
            foreach ($alternative as $keyAlternative => $valueAlternative) {
                for ($i=0; $i < count($alternative); $i++) { 
                    if ($i <= $keyAlternative) {
                        $hamming1[$keyAlternative][$i] = ["-"];
                        $hamming2[$keyAlternative][$i] = ["-"];
                    } else {
                        $hamming1[$keyAlternative][$i] = $this->hammingDistance($weightedNormalizedFuzzyDecisionMatrix[$keyAlternative][0], $weightedNormalizedFuzzyDecisionMatrix[$i][0]);
                        $hamming2[$keyAlternative][$i] = $this->hammingDistance($weightedNormalizedFuzzyDecisionMatrix[$keyAlternative][1], $weightedNormalizedFuzzyDecisionMatrix[$i][1]);
                    }
                }
            }
        
            // form the discordance matrix
            foreach ($alternative as $keyAlternative => $value) {
                for ($i=0; $i < count($alternative); $i++) {
                    if ($i == $keyAlternative) { //alternatives are same
                        $discordanceMatrix[$keyAlternative][$i] = "-";
                    } else {
                        if ( implode($hamming1[$keyAlternative][$i])  !== "-" && implode($hamming2[$keyAlternative][$i] ) !== "-" ) {
                            if ( max(abs($hamming1[$keyAlternative][$i]['kiri'] - $hamming1[$keyAlternative][$i]['kanan']), abs($hamming2[$keyAlternative][$i]['kiri'] - $hamming2[$keyAlternative][$i]['kanan'])) == 0 ) {
                                $discordanceMatrix[$keyAlternative][$i] = 0;
                            } else {
                                $discordanceMatrix[$keyAlternative][$i] = max(($hamming1[$keyAlternative][$i]['discordanceSet'] == "yes" ) ? abs($hamming1[$keyAlternative][$i]['kiri'] - $hamming1[$keyAlternative][$i]['kanan'])  : 0,  ($hamming2[$keyAlternative][$i]['discordanceSet'] == "yes") ? abs($hamming2[$keyAlternative][$i]['kiri'] - $hamming2[$keyAlternative][$i]['kanan'])  : 0  ) / max(abs($hamming1[$keyAlternative][$i]['kiri'] - $hamming1[$keyAlternative][$i]['kanan']), abs($hamming2[$keyAlternative][$i]['kiri'] - $hamming2[$keyAlternative][$i]['kanan'])) ;   
                            }
                        } else {
                            if ( max(abs($hamming1[$i][$keyAlternative]['kiri'] - $hamming1[$i][$keyAlternative]['kanan']), abs($hamming2[$i][$keyAlternative]['kiri'] - $hamming2[$i][$keyAlternative]['kanan'])) == 0) {
                                $discordanceMatrix[$keyAlternative][$i] = 0;
                            } else {
                                $discordanceMatrix[$keyAlternative][$i] = max(($hamming1[$i][$keyAlternative]['discordanceSet'] == "no" ) ? abs($hamming1[$i][$keyAlternative]['kiri'] - $hamming1[$i][$keyAlternative]['kanan'])  : 0,  ($hamming2[$i][$keyAlternative]['discordanceSet'] == "no") ? abs($hamming2[$i][$keyAlternative]['kiri'] - $hamming2[$i][$keyAlternative]['kanan'])  : 0  ) / max(abs($hamming1[$i][$keyAlternative]['kiri'] - $hamming1[$i][$keyAlternative]['kanan']), abs($hamming2[$i][$keyAlternative]['kiri'] - $hamming2[$i][$keyAlternative]['kanan'])) ; 
                            }
                        }
                    }   
                }
            }
            return $discordanceMatrix;
        }

        /**concordanceLevel
         * calculate the concordance level of a concordance matrix
         *PARAM
         * $concordanceMatrix = concordance matrix
         *RETURNS
         * $concordanceLevel = concordance level : array[] float
         * 
         */
        function concordanceLevel ($concordanceMatrix)
        {   
            $concordanceLevel = array();
            $kiri = array();
            $tengah = array();
            $kanan = array();
            
            foreach ($concordanceMatrix as $concordanceKey => $concordanceValue) {
                foreach ($concordanceValue as $alternativeKey => $alternativeValue) {
                    array_push($kiri, $concordanceMatrix[$concordanceKey][$alternativeKey][0]);
                    array_push($tengah, $concordanceMatrix[$concordanceKey][$alternativeKey][1]);
                    array_push($kanan, $concordanceMatrix[$concordanceKey][$alternativeKey][2]);
                }
            }
            
            $kiri = array_sum($kiri) / (count($kiri)-count($concordanceMatrix));
            $kanan = array_sum($kanan) / (count($kanan)-count($concordanceMatrix));
            $tengah = array_sum($tengah) / (count($tengah)-count($concordanceMatrix));
            
            $concordanceLevel = ['kiri' => $kiri, 'tengah' => $tengah, 'kanan' => $kanan];
            
            return $concordanceLevel;
        }
        
        /**discordanceLevel
         * calculate the discordance level of a concordance matrix
         *PARAM
         * $discordanceMatrix =  discordance matrix
         *RETURNS
         * $ discordanceLevel =  discordance level : float
         * 
         */
        function discordanceLevel ($discordanceMatrix)
        {
            $discordanceLevel = 0;
            $count = 0;

            foreach ($discordanceMatrix as $discordanceKey => $discordanceValue) {
                foreach ($discordanceValue as $alternativeKey => $alternativeValue) {
                    if (is_numeric($discordanceMatrix[$discordanceKey][$alternativeKey])) {
                        $discordanceLevel = $discordanceLevel + $discordanceMatrix[$discordanceKey][$alternativeKey];
                        $count = $count + 1;
                    }
                }
            }

            $discordanceLevel = $discordanceLevel / $count;
            return $discordanceLevel;
        }
        
        /**matrixBooleanB
         * form the Boolean B Matrix
         *PARAMS
         * $concordanceMatrix = concordance matrix : array[][][] float
         * $concordanceLevel = concordance level : array [] float
         *RETURNS
         * $matrixBooleanB = boolean b matrix : array[][] int
         * 
         * STEP 12 FORM THE BOOLEAN B AND H MATRICES
         */
        function matrixBooleanB($concordanceMatrix, $concordanceLevel)
        {
            $matrixBooleanB = array();
            
            foreach ($concordanceMatrix as $concordanceKey => $concordanceValue) {
                foreach ($concordanceValue as $alternativeKey => $alternativeValue) {
                    if ($alternativeValue === ["-","-","-"]) {
                        $matrixBooleanB[$concordanceKey][$alternativeKey] = "-";
                    } else {
                        if ($alternativeValue[0] > $concordanceLevel['kiri'] && $alternativeValue[1] > $concordanceLevel['tengah'] && $alternativeValue[2] > $concordanceLevel['kanan']) {
                            $matrixBooleanB[$concordanceKey][$alternativeKey] = 1;
                        } else {
                            $matrixBooleanB[$concordanceKey][$alternativeKey] = 0;
                        }
                    }
                }
            }

            return $matrixBooleanB;
        }

        /**matrixBooleanH
         * form the Boolean H Matrix
         *PARAMS
         * $discordanceMatrix = discordance matrix : array[][][] float
         * $discordanceLevel = discordance level : array [] float
         *RETURNS
         * $matrixBooleanH = boolean H matrix : array[][] int
         * 
         * STEP 12 FORM THE BOOLEAN B AND H MATRICES
         */
        function matrixBooleanH($discordanceMatrix, $discordanceLevel)
        {
            $matrixBooleanH = array();
            
            foreach ($discordanceMatrix as $discordanceKey => $discordanceValue) {
                foreach ($discordanceValue as $alternativeKey => $alternativeValue) {
                    if ($alternativeValue === "-") {
                        $matrixBooleanH[$discordanceKey][$alternativeKey] = "-";
                    } else {
                        if ($alternativeValue > $discordanceLevel) {
                            $matrixBooleanH[$discordanceKey][$alternativeKey] = 0;
                        } elseif ($alternativeValue < $discordanceLevel) {
                            $matrixBooleanH[$discordanceKey][$alternativeKey] = 1;
                        }
                    }
                }
            }
            return $matrixBooleanH;
        }
        
        /**matrixGlobalZ
         * form the global z matrix
         *PARAMS
         * $matrixBooleanB = boolean b matrix : array[][] float
         * $matrixBooleanH = boolean h matrix : array[][] float
         *RETURNS
         * $matrixGlobalZ : global matrix z : array[][]
         */
        function matrixGlobalZ($matrixBooleanB, $matrixBooleanH)
        {
            $matrixGlobalZ = array();

            foreach ($matrixBooleanB as $keyAlternative => $alternativeValue) {
                foreach ($alternativeValue as $key => $value) {
                    if ($value === "-") {
                        $matrixGlobalZ[$keyAlternative][$key] = "-";
                    } else {
                        $matrixGlobalZ[$keyAlternative][$key] = $matrixBooleanB[$keyAlternative][$key] * $matrixBooleanH[$keyAlternative][$key];
                    }
                }
            }
            return $matrixGlobalZ;
        }

        /**getRanking
         * ranks the alternatives according to global matrix z
         *PARAMS
         * $matrixGlobalZ = global matrix z : array[][] float
         *RETURN
         * $ranking = 5 best alternatives : array[] int
         */
        function getRanking($matrixGlobalZ) 
        {
            $ranking = array();
            $unsorted = array();

            //determines the value of an alternative from global z matrix
            foreach ($matrixGlobalZ as $key => $value) {
                array_push($unsorted, array_sum($value));
            }
            //sort the alternatives by the values
            arsort($unsorted);
            //get top 5 alternatives
            $ranking = array_slice($unsorted,0,5, true);
        
            return $ranking;
        }
    }



?>