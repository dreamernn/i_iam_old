<?php

class FeedbackModel extends \BaseModel {

    public function getQuestionList($paramList) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['question'] ? $params['question'] = $paramList['question'] : false;
            $paramList['type'] ? $params['type'] = $paramList['type'] : false;
            isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('F001', $params);
        } while (false);
        return (array)$result;
    }

    public function saveQuestionDataInfo($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['question'] ? $params['question'] = $paramList['question'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['type'] ? $params['type'] = $paramList['type'] : false;
            $paramList['sort'] ? $params['sort'] = $paramList['sort'] : false;
            !is_null($paramList['status']) ? $params['status'] = intval($paramList['status']) : false;

            $checkParams = Enum_Feedback::getFeedbackMustInput();
            foreach ($checkParams as $checkParamOne) {
                if (empty($params[$checkParamOne])) {
                    break 2;
                }
            }

            $interfaceId = $params['id'] ? 'F003' : 'F002';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        } while (false);
        return $result;
    }

    public function saveQuestionOptionInfo($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['option'] ? $params['option'] = $paramList['option'] : false;

            if (empty($params['id'])) {
                break;
            }
            $result = $this->rpcClient->getResultRaw('F003', $params);
        } while (false);
        return $result;
    }

    public function getResultList($paramList) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('F004', $params);
        } while (false);
        return (array)$result;
    }
}
