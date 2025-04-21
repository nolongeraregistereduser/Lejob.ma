import React from 'react';

const CvForm = ({ formData, onFormChange, onTemplateChange, selectedTemplate }) => {
  const handleChange = (e) => {
    const { name, value } = e.target;
    onFormChange(name, value);
  };

  return (
    <div className="cv-form">
      <div className="mb-6">
        <h2 className="text-xl font-semibold mb-4">Choose Template</h2>
        <div className="grid grid-cols-2 gap-4">
          <div 
            className={`template-option p-3 border-2 rounded-md cursor-pointer transition ${selectedTemplate === 'template1' ? 'border-blue-500 bg-blue-50' : 'border-gray-200'}`}
            onClick={() => onTemplateChange('template1')}
          >
            <div className="bg-blue-500 text-white text-center p-2 rounded mb-2">Modern Template</div>
            <div className="h-24 bg-gray-100 rounded flex items-center justify-center">
              <span className="text-sm text-gray-600">Modern & Professional</span>
            </div>
          </div>
          
          <div 
            className={`template-option p-3 border-2 rounded-md cursor-pointer transition ${selectedTemplate === 'template2' ? 'border-blue-500 bg-blue-50' : 'border-gray-200'}`}
            onClick={() => onTemplateChange('template2')}
          >
            <div className="bg-gray-800 text-white text-center p-2 rounded mb-2">Classic Template</div>
            <div className="h-24 bg-gray-100 rounded flex items-center justify-center">
              <span className="text-sm text-gray-600">Clean & Traditional</span>
            </div>
          </div>
        </div>
      </div>
      
      <h2 className="text-xl font-semibold mb-4">Personal Information</h2>
      <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div>
          <label className="block text-sm font-medium mb-1">Full Name</label>
          <input
            type="text"
            name="name"
            value={formData.name}
            onChange={handleChange}
            className="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          />
        </div>
        
        <div>
          <label className="block text-sm font-medium mb-1">Job Title</label>
          <input
            type="text"
            name="titre"
            value={formData.titre}
            onChange={handleChange}
            className="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          />
        </div>
        
        <div>
          <label className="block text-sm font-medium mb-1">Email</label>
          <input
            type="email"
            name="email"
            value={formData.email}
            onChange={handleChange}
            className="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          />
        </div>
        
        <div>
          <label className="block text-sm font-medium mb-1">Phone</label>
          <input
            type="tel"
            name="phone"
            value={formData.phone}
            onChange={handleChange}
            className="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          />
        </div>
      </div>
      
      <div className="mb-6">
        <label className="block text-sm font-medium mb-1">Skills</label>
        <textarea
          name="skills"
          value={formData.skills}
          onChange={handleChange}
          className="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          rows="3"
          placeholder="Separate skills with commas (e.g., JavaScript, React, Node.js)"
        ></textarea>
      </div>
      
      <div className="mb-6">
        <label className="block text-sm font-medium mb-1">Work Experience</label>
        <textarea
          name="experience"
          value={formData.experience}
          onChange={handleChange}
          className="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          rows="4"
          placeholder="Format: Company | Position | Date | Description"
        ></textarea>
      </div>
      
      <div className="mb-6">
        <label className="block text-sm font-medium mb-1">Education</label>
        <textarea
          name="education"
          value={formData.education}
          onChange={handleChange}
          className="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          rows="4"
          placeholder="Format: Institution | Degree | Date | Description"
        ></textarea>
      </div>
      
      <div className="mb-6">
        <label className="block text-sm font-medium mb-1">Certifications</label>
        <textarea
          name="certifications"
          value={formData.certifications}
          onChange={handleChange}
          className="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          rows="3"
          placeholder="Format: Certification | Issuer | Date"
        ></textarea>
      </div>
      
      <div className="mb-6">
        <label className="block text-sm font-medium mb-1">Languages</label>
        <textarea
          name="languages"
          value={formData.languages}
          onChange={handleChange}
          className="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          rows="2"
          placeholder="Format: Language (Proficiency Level)"
        ></textarea>
      </div>
      
      <div className="mb-6">
        <label className="block text-sm font-medium mb-1">Projects</label>
        <textarea
          name="projects"
          value={formData.projects}
          onChange={handleChange}
          className="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          rows="4"
          placeholder="Format: Project Name | Description | Technologies | URL (optional)"
        ></textarea>
      </div>
    </div>
  );
};

export default CvForm;