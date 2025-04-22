import React from 'react';

const CvPreview = ({ formData, template }) => {
  // Helper function to parse multi-line text into arrays
  const parseTextToArray = (text) => {
    return text ? text.split(/\r?\n/).filter(item => item.trim() !== '') : [];
  };
  
  // Preview pour Modèle 1 (Moderne)
  const renderTemplate1 = () => {
    const skills = formData.skills ? formData.skills.split(',').map(skill => skill.trim()).filter(skill => skill !== '') : [];
    const experiences = parseTextToArray(formData.experience);
    const education = parseTextToArray(formData.education);
    const certifications = parseTextToArray(formData.certifications);
    const languages = parseTextToArray(formData.languages);
    const projects = parseTextToArray(formData.projects);
    
    return (
      <div className="template1-preview bg-white min-h-[1000px]">
        <div className="header bg-blue-600 text-white p-6">
          <h1 className="text-3xl font-bold">{formData.name || 'Votre Nom'}</h1>
          <p className="text-xl mt-1">{formData.titre || 'Votre Poste'}</p>
          <div className="contact-info mt-3 flex flex-wrap gap-4">
            <span>{formData.email || 'votre.email@example.com'}</span>
            <span>{formData.phone || '+212 6XX-XXXXXX'}</span>
          </div>
        </div>
        
        <div className="content p-6">
          {skills.length > 0 && (
            <div className="mb-6">
              <h2 className="text-xl font-semibold border-b-2 border-blue-600 pb-1 mb-3">Compétences</h2>
              <div className="flex flex-wrap gap-2">
                {skills.map((skill, index) => (
                  <span key={index} className="bg-blue-100 text-blue-800 rounded-full px-3 py-1 text-sm">
                    {skill}
                  </span>
                ))}
              </div>
            </div>
          )}
          
          {experiences.length > 0 && (
            <div className="mb-6">
              <h2 className="text-xl font-semibold border-b-2 border-blue-600 pb-1 mb-3">Expérience</h2>
              {experiences.map((exp, index) => (
                <div key={index} className="mb-4">
                  <p className="text-gray-800">{exp}</p>
                </div>
              ))}
            </div>
          )}
          
          {education.length > 0 && (
            <div className="mb-6">
              <h2 className="text-xl font-semibold border-b-2 border-blue-600 pb-1 mb-3">Formation</h2>
              {education.map((edu, index) => (
                <div key={index} className="mb-4">
                  <p className="text-gray-800">{edu}</p>
                </div>
              ))}
            </div>
          )}
          
          {certifications.length > 0 && (
            <div className="mb-6">
              <h2 className="text-xl font-semibold border-b-2 border-blue-600 pb-1 mb-3">Certifications</h2>
              {certifications.map((cert, index) => (
                <div key={index} className="mb-2">
                  <p className="text-gray-800">{cert}</p>
                </div>
              ))}
            </div>
          )}
          
          {languages.length > 0 && (
            <div className="mb-6">
              <h2 className="text-xl font-semibold border-b-2 border-blue-600 pb-1 mb-3">Langues</h2>
              <div className="flex flex-wrap gap-4">
                {languages.map((lang, index) => (
                  <span key={index} className="text-gray-800">
                    {lang}
                  </span>
                ))}
              </div>
            </div>
          )}
          
          {projects.length > 0 && (
            <div className="mb-6">
              <h2 className="text-xl font-semibold border-b-2 border-blue-600 pb-1 mb-3">Projets</h2>
              {projects.map((proj, index) => (
                <div key={index} className="mb-4">
                  <p className="text-gray-800">{proj}</p>
                </div>
              ))}
            </div>
          )}
        </div>
      </div>
    );
  };
  
  // Preview pour Modèle 2 (Classique)
  const renderTemplate2 = () => {
    const skills = formData.skills ? formData.skills.split(',').map(skill => skill.trim()).filter(skill => skill !== '') : [];
    const experiences = parseTextToArray(formData.experience);
    const education = parseTextToArray(formData.education);
    const certifications = parseTextToArray(formData.certifications);
    const languages = parseTextToArray(formData.languages);
    const projects = parseTextToArray(formData.projects);
    
    return (
      <div className="template2-preview min-h-[1000px] flex">
        {/* Sidebar */}
        <div className="w-1/3 bg-gray-800 text-white p-6">
          <div className="mb-8 text-center">
            <h1 className="text-2xl font-bold uppercase tracking-wide">{formData.name || 'Votre Nom'}</h1>
            <p className="text-lg mt-2 text-gray-300">{formData.titre || 'Votre Poste'}</p>
          </div>
          
          <div className="mb-6">
            <h2 className="text-lg font-semibold mb-3 pb-2 border-b border-gray-600">Contact</h2>
            <div className="space-y-2">
              <p className="flex items-center gap-2 text-sm">
                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                {formData.email || 'votre.email@example.com'}
              </p>
              <p className="flex items-center gap-2 text-sm">
                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                {formData.phone || '+212 6XX-XXXXXX'}
              </p>
            </div>
          </div>
          
          {skills.length > 0 && (
            <div className="mb-6">
              <h2 className="text-lg font-semibold mb-3 pb-2 border-b border-gray-600">Compétences</h2>
              <div className="space-y-1">
                {skills.map((skill, index) => (
                  <p key={index} className="text-sm">• {skill}</p>
                ))}
              </div>
            </div>
          )}
          
          {languages.length > 0 && (
            <div className="mb-6">
              <h2 className="text-lg font-semibold mb-3 pb-2 border-b border-gray-600">Langues</h2>
              <div className="space-y-1">
                {languages.map((lang, index) => (
                  <p key={index} className="text-sm">• {lang}</p>
                ))}
              </div>
            </div>
          )}
          
          {certifications.length > 0 && (
            <div className="mb-6">
              <h2 className="text-lg font-semibold mb-3 pb-2 border-b border-gray-600">Certifications</h2>
              <div className="space-y-1">
                {certifications.map((cert, index) => (
                  <p key={index} className="text-sm">• {cert}</p>
                ))}
              </div>
            </div>
          )}
        </div>
        
        {/* Main Content */}
        <div className="w-2/3 bg-white p-6">
          {experiences.length > 0 && (
            <div className="mb-6">
              <h2 className="text-xl font-semibold mb-3 pb-2 border-b border-gray-300">Expérience Professionnelle</h2>
              {experiences.map((exp, index) => (
                <div key={index} className="mb-4">
                  <p className="text-gray-800">{exp}</p>
                </div>
              ))}
            </div>
          )}
          
          {education.length > 0 && (
            <div className="mb-6">
              <h2 className="text-xl font-semibold mb-3 pb-2 border-b border-gray-300">Formation</h2>
              {education.map((edu, index) => (
                <div key={index} className="mb-4">
                  <p className="text-gray-800">{edu}</p>
                </div>
              ))}
            </div>
          )}
          
          {projects.length > 0 && (
            <div className="mb-6">
              <h2 className="text-xl font-semibold mb-3 pb-2 border-b border-gray-300">Projets</h2>
              {projects.map((proj, index) => (
                <div key={index} className="mb-4">
                  <p className="text-gray-800">{proj}</p>
                </div>
              ))}
            </div>
          )}
        </div>
      </div>
    );
  };
  
  return (
    <div className="cv-preview overflow-auto max-h-[800px] scale-[0.9] origin-top">
      {template === 'template1' ? renderTemplate1() : renderTemplate2()}
    </div>
  );
};

export default CvPreview;
