<?php

namespace App\Models;

use CodeIgniter\Model;

class AcademyModel extends Model
{
    protected $table = 'academy_stg';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id', 'edu_office_code', 'edu_office_name', 'administrative_area',
        'academy_type_name', 'academy_license_number', 'academy_name',
        'open_date', 'registration_date', 'registration_status',
        'suspension_start_date', 'suspension_end_date',
        'total_capacity', 'temporary_capacity', 'field_name', 'teaching_category',
        'course_list_name', 'course_name', 'fee_per_person', 'fee_disclosure_yn',
        'boarding_academy_yn', 'road_address', 'road_address_detail',
        'road_postal_code', 'phone_number', 'updated_at', 'latitude', 'longitude'
    ];

    protected $useTimestamps = false;

    /**
     * 데이터 조회 시 인코딩 변환 처리
     */
    protected function convertEncoding($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_string($value)) {
                    // UTF-8이 아닌 경우 변환 시도
                    if (!mb_check_encoding($value, 'UTF-8')) {
                        // 여러 인코딩 시도
                        $detected = mb_detect_encoding($value, ['UTF-8', 'EUC-KR', 'CP949', 'ISO-8859-1', 'ASCII'], true);
                        if ($detected && $detected !== 'UTF-8') {
                            $converted = mb_convert_encoding($value, 'UTF-8', $detected);
                            if ($converted !== false) {
                                $data[$key] = $converted;
                            }
                        } else {
                            // 자동 감지 실패 시 기본 변환 시도
                            $data[$key] = mb_convert_encoding($value, 'UTF-8', 'EUC-KR,CP949,ISO-8859-1');
                        }
                    }
                } elseif (is_array($value)) {
                    $data[$key] = $this->convertEncoding($value);
                }
            }
        } elseif (is_string($data)) {
            if (!mb_check_encoding($data, 'UTF-8')) {
                $detected = mb_detect_encoding($data, ['UTF-8', 'EUC-KR', 'CP949', 'ISO-8859-1', 'ASCII'], true);
                if ($detected && $detected !== 'UTF-8') {
                    $converted = mb_convert_encoding($data, 'UTF-8', $detected);
                    if ($converted !== false) {
                        $data = $converted;
                    }
                } else {
                    $data = mb_convert_encoding($data, 'UTF-8', 'EUC-KR,CP949,ISO-8859-1');
                }
            }
        }
        return $data;
    }

    /**
     * find 메서드 오버라이드 - 인코딩 변환 추가
     */
    public function find($id = null)
    {
        $result = parent::find($id);
        if ($result) {
            return $this->convertEncoding($result);
        }
        return $result;
    }

    /**
     * findAll 메서드 오버라이드 - 인코딩 변환 추가
     */
    public function findAll(int $limit = null, int $offset = 0)
    {
        $results = parent::findAll($limit, $offset);
        if ($results) {
            return array_map([$this, 'convertEncoding'], $results);
        }
        return $results;
    }

    /**
     * paginate 메서드 오버라이드 - 인코딩 변환 추가
     */
    public function paginate(?int $perPage = null, string $group = 'default', ?int $page = null, int $segment = 0)
    {
        $results = parent::paginate($perPage, $group, $page, $segment);
        if ($results && is_array($results)) {
            foreach ($results as $key => $result) {
                $results[$key] = $this->convertEncoding($result);
            }
        }
        return $results;
    }
}
