# SEO 리팩토링 변경 요약

## 변경 사항

### 1. **중복 분기 제거**
- academy 분기가 중복되어 있던 버그 제거 (7-34줄과 73-112줄)
- 단일 분기로 통합하여 유지보수성 향상

### 2. **SEO 메타 개선**
- Title/Description에 지역(province, district, administrative_area)과 핵심 속성(academy_type, daycare_type) 포함
- 검색 친화적인 문구로 개선 (예: "서울 강남구 (국공립) 어린이집")
- Keywords에 지역 정보 자동 포함

### 3. **JSON-LD 구조화 데이터 정확성 향상**
- 조건부 필드 처리: 데이터가 없으면 필드 자체를 생략
- 학원: road_address + road_address_detail 합치기, 전화번호/위도경도 조건부
- 어린이집: openingHours 제거 (실제 시간 정보 없음), 위도경도 조건부
- 빈 값 체크 강화 (trim, empty 체크)

### 4. **소셜 공유 최적화**
- og:image, twitter:image 추가 (기본 이미지 경로 변수화)
- og:image:width, og:image:height, og:image:alt 추가
- og:type을 상세 페이지는 "article", 홈은 "website"로 구분

### 5. **코드 구조 개선**
- 우선순위 명확화: 컨트롤러 SEO > academy > daycare > fallback
- null 안전장치 추가
- 주석으로 의도 명확화

---

## SEO/구조화데이터 검증 체크리스트

### ✅ 필수 검증 항목

- [ ] **Title 태그 검증**
  - 각 페이지별 고유한 title (중복 없음)
  - 지역/타입 정보 포함 여부 확인
  - 길이 60자 이내 권장

- [ ] **Description 메타 검증**
  - 각 페이지별 고유한 description
  - 핵심 키워드 포함 여부
  - 길이 160자 이내 권장

- [ ] **Canonical URL 검증**
  - 모든 페이지에 canonical 태그 존재
  - 자기 자신을 가리키는지 확인

- [ ] **JSON-LD 구조화 데이터 검증**
  - Google Rich Results Test로 검증: https://search.google.com/test/rich-results
  - 필수 필드만 포함 (빈 값 필드 제외)
  - @type이 정확한지 확인 (EducationalOrganization, ChildCare, WebSite)

- [ ] **Open Graph 메타 검증**
  - Facebook Sharing Debugger로 검증: https://developers.facebook.com/tools/debug/
  - og:image가 정상 로드되는지 확인
  - og:type이 적절한지 확인 (article vs website)

- [ ] **Twitter Card 검증**
  - Twitter Card Validator로 검증: https://cards-dev.twitter.com/validator
  - twitter:image가 정상 로드되는지 확인

- [ ] **조건부 필드 검증**
  - 전화번호 없을 때 telephone 필드 생략 확인
  - 위도/경도 없을 때 geo 필드 생략 확인
  - 주소 없을 때 address 필드 생략 확인

- [ ] **로봇 크롤링 최적화**
  - robots.txt에 sitemap URL 포함 확인
  - robots 메타 태그 "index, follow" 확인

---

## 테스트 방법

1. **로컬 테스트**
   ```bash
   # 각 페이지별로 다음 확인:
   - View Source로 메타 태그 확인
   - 브라우저 개발자 도구 > Elements에서 JSON-LD 확인
   ```

2. **온라인 검증 도구**
   - Google Rich Results Test
   - Facebook Sharing Debugger
   - Twitter Card Validator
   - Schema.org Validator

3. **실제 배포 후 확인**
   - Google Search Console에서 구조화 데이터 오류 확인
   - 소셜 미디어에서 공유 테스트

---

## 주의사항

- `$ogImage` 변수는 컨트롤러에서 설정 가능 (기본값: `base_url('assets/images/og-default.png')`)
- 실제 OG 이미지 파일을 `public/assets/images/og-default.png`에 배치 필요
- 이미지 권장 크기: 1200x630px (Facebook/Twitter 최적 크기)

